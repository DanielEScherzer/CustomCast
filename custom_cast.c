/* custom_cast extension for PHP */

#ifdef HAVE_CONFIG_H
# include "config.h"
#endif

#include "php.h"
#include "ext/standard/info.h"
#include "php_custom_cast.h"
#include "Zend/zend_API.h"
#include "Zend/zend_ast.h"
#include "Zend/zend_attributes.h"
#include "Zend/zend_enum.h"
#include "Zend/zend_execute.h"
#include "Zend/zend_hash.h"
#include "Zend/zend_objects.h"
#include "Zend/zend_object_handlers.h"
#include "Zend/zend_types.h"
#include "custom_cast_arginfo.h"


ZEND_API zend_class_entry *custom_cast_attrib_ce;
ZEND_API zend_class_entry *custom_cast_type_enum_ce;
ZEND_API zend_class_entry *custom_cast_castable_interface_ce;

static zend_object_handlers custom_cast_obj_handlers;

ZEND_METHOD(CustomCastable, __construct)
{
	ZEND_PARSE_PARAMETERS_NONE();
}

static zend_result get_cast_enum_val( int type, zval *param ) {
	if (type == _IS_BOOL) {
		zend_class_constant *c = zend_hash_str_find_ptr(
			&(custom_cast_type_enum_ce->constants_table),
			"CAST_BOOL",
			sizeof( "CAST_BOOL" ) - 1
		);
		ZEND_ASSERT(c && "Valid enum case");
		if (Z_TYPE(c->value) == IS_CONSTANT_AST) {
			zval_update_constant_ex(&c->value, c->ce);
		}
		ZVAL_COPY_VALUE(param, &(c->value));
		return SUCCESS;
	}
	if (type == IS_LONG) {
		zend_class_constant *c = zend_hash_str_find_ptr(
			&(custom_cast_type_enum_ce->constants_table),
			"CAST_LONG",
			sizeof( "CAST_LONG" ) - 1
		);
		ZEND_ASSERT(c && "Valid enum case");
		if (Z_TYPE(c->value) == IS_CONSTANT_AST) {
			zval_update_constant_ex(&c->value, c->ce);
		}
		ZVAL_COPY_VALUE(param, &(c->value));
		return SUCCESS;
	}
	if (type == IS_DOUBLE) {
		zend_class_constant *c = zend_hash_str_find_ptr(
			&(custom_cast_type_enum_ce->constants_table),
			"CAST_FLOAT",
			sizeof( "CAST_FLOAT" ) - 1
		);
		ZEND_ASSERT(c && "Valid enum case");
		if (Z_TYPE(c->value) == IS_CONSTANT_AST) {
			zval_update_constant_ex(&c->value, c->ce);
		}
		ZVAL_COPY_VALUE(param, &(c->value));
		return SUCCESS;
	}
	return FAILURE;
}

static zend_result custom_cast_do_cast(
	zend_object *readobj,
	zval *writeobj,
	int type
) {
	if (type == IS_STRING) {
		// there is no __doCast() with string, we defer to __toString()
		return zend_std_cast_object_tostring(readobj, writeobj, type);
	}

	zval castParam;
	zend_result canCast = get_cast_enum_val(type, &castParam);
	if (canCast == FAILURE) {
		return FAILURE;
	}

	zval fcallReturn;

	zend_function *castFn = zend_hash_str_find_ptr(
		&( readobj->ce->function_table ),
		"__docast",
		sizeof("__docast") - 1
	);

	zend_call_known_instance_method_with_1_params(
		castFn,
		readobj,
		&fcallReturn,
		&castParam
	);

	if (Z_ISUNDEF(fcallReturn) || Z_ISNULL(fcallReturn)) {
		zval_ptr_dtor(&castParam);
		// match zend_std_cast_object_tostring if the developer explicitly
		// hasn't returned anything for booleans
		if (type == _IS_BOOL) {
			ZVAL_TRUE(writeobj);
			return SUCCESS;
		}
		return FAILURE;
	}
	if (type == _IS_BOOL) {
		if (EXPECTED(
			Z_TYPE_INFO(fcallReturn) == IS_TRUE
			|| Z_TYPE_INFO(fcallReturn) == IS_FALSE
		) ) {
			ZVAL_COPY(writeobj, &fcallReturn);
			return SUCCESS;
		}
		zval_ptr_dtor(&castParam);
		zend_error_noreturn(
			E_ERROR,
			"Method %s::__doCast() did not return a boolean",
			ZSTR_VAL(readobj->ce->name)
		);
	}
	if (type == IS_LONG) {
		if (EXPECTED(Z_TYPE_INFO(fcallReturn) == IS_LONG) ) {
			ZVAL_COPY(writeobj, &fcallReturn);
			return SUCCESS;
		}
		zval_ptr_dtor(&castParam);
		zend_error_noreturn(
			E_ERROR,
			"Method %s::__doCast() did not return an integer",
			ZSTR_VAL(readobj->ce->name)
		);
	}
	if (type == IS_DOUBLE) {
		if (EXPECTED(Z_TYPE_INFO(fcallReturn) == IS_DOUBLE) ) {
			ZVAL_COPY(writeobj, &fcallReturn);
			return SUCCESS;
		}
		zval_ptr_dtor(&castParam);
		zend_error_noreturn(
			E_ERROR,
			"Method %s::__doCast() did not return a floating-point number",
			ZSTR_VAL(readobj->ce->name)
		);
	}
	
	return FAILURE;
}

static void require_user_class(uint32_t flags) {
	// Must actually be on a class
	if (flags & ZEND_ACC_ENUM) {
		zend_error_noreturn(E_ERROR, "Cannot apply #[CustomCastable] to enum");
	}
	if (flags & ZEND_ACC_INTERFACE) {
		zend_error_noreturn(E_ERROR, "Cannot apply #[CustomCastable] to interface");
	}
	if (flags & ZEND_ACC_TRAIT) {
		zend_error_noreturn(E_ERROR, "Cannot apply #[CustomCastable] to trait");
	}
	if (flags & ZEND_ACC_LINKED) {
		zend_error_noreturn(
			E_ERROR,
			"#[CustomCastable] is for user classes, internal classes can set a custom cast handler"
		);
	}

}
static void ensure_class_has_interface(zend_class_entry *scope) {
	ZEND_ASSERT(!(scope->ce_flags & ZEND_ACC_LINKED));
	// zend_compile_class_decl() runs zend_compile_attributes() before the
	// zend_compile_stmt() that sets up the actual body of the class, so we
	// cannot just check if the __doCast() function is there based on the
	// function_table. We could add some ugly logic to (ab)use the observer
	// system to do the validation after the fact, but instead, lets just
	// add the `HaveCustomCast` interface, and when the interfaces get validated
	// that will enforce that the method exists - inspired by how `Stringable`
	// always gets added
	for (uint32_t iii = 0; iii < scope->num_interfaces; iii++) {
		if (zend_string_equals_literal(
			scope->interface_names[iii].lc_name,
			"hascustomcast"
		)) {
			// Interface was added manually be the developer, weird but okay
			return;
		}
	}

	// Must not have been added directly; add it automatically, but only as
	// as part of the list of interfaces, not checking it now because that will
	// be done automatically, i.e. not doing
	// zend_class_implements(scope, 1, custom_cast_castable_interface_ce);
	const uint32_t interfaceIdx = scope->num_interfaces;
	scope->num_interfaces++;

	zend_class_name *newInterfaceSet = erealloc(
		scope->interface_names,
		sizeof(zend_class_name) * scope->num_interfaces
	);
	newInterfaceSet[interfaceIdx].name = zend_string_init("HasCustomCast", sizeof("HasCustomCast") - 1, 0);
	newInterfaceSet[interfaceIdx].lc_name = zend_string_init("hascustomcast", sizeof("hascustomcast") - 1, 0);
	scope->interface_names = newInterfaceSet;
}

static void validate_custom_castable(
		zend_attribute *attr, uint32_t target, zend_class_entry *scope)
{
	require_user_class(scope->ce_flags);
	ensure_class_has_interface(scope);
	scope->default_object_handlers = &custom_cast_obj_handlers;
}

static void setup_CustomCastable_as_attribute(zend_class_entry *class_entry) {
	// Generation script doesn't yet handle attributes, so we need to manually
	// register that this is an attribute
	zend_string *attribute_name_Attribute_class_CustomCastable_0 = zend_string_init_interned("Attribute", sizeof("Attribute") - 1, 1);
	zend_attribute *attribute_Attribute_class_CustomCastable_0 = zend_add_class_attribute(class_entry, attribute_name_Attribute_class_CustomCastable_0, 1);
	zend_string_release(attribute_name_Attribute_class_CustomCastable_0);
	zval attribute_Attribute_class_CustomCastable_0_arg0;
	ZVAL_LONG(&attribute_Attribute_class_CustomCastable_0_arg0, ZEND_ATTRIBUTE_TARGET_CLASS);
	ZVAL_COPY_VALUE(&attribute_Attribute_class_CustomCastable_0->args[0].value, &attribute_Attribute_class_CustomCastable_0_arg0);
}

static PHP_MINIT_FUNCTION(custom_cast) {
	custom_cast_attrib_ce = register_class_CustomCastable();
	setup_CustomCastable_as_attribute(custom_cast_attrib_ce);

	zend_internal_attribute *attr_internal;
	attr_internal = zend_mark_internal_attribute(custom_cast_attrib_ce);
	attr_internal->validator = validate_custom_castable;

	custom_cast_type_enum_ce = register_class_CastableTarget();
	custom_cast_castable_interface_ce = register_class_HasCustomCast();

	memcpy(
		&custom_cast_obj_handlers,
		&std_object_handlers,
		sizeof(zend_object_handlers)
	);
	custom_cast_obj_handlers.cast_object = custom_cast_do_cast;

	return SUCCESS;
}

/* {{{ PHP_RINIT_FUNCTION */
PHP_RINIT_FUNCTION(custom_cast)
{
#if defined(ZTS) && defined(COMPILE_DL_CUSTOM_CAST)
	ZEND_TSRMLS_CACHE_UPDATE();
#endif

	return SUCCESS;
}
/* }}} */

/* {{{ PHP_MINFO_FUNCTION */
PHP_MINFO_FUNCTION(custom_cast)
{
	php_info_print_table_start();
	php_info_print_table_row(2, "custom_cast support", "enabled");
	php_info_print_table_end();
}
/* }}} */

/* {{{ custom_cast_module_entry */
zend_module_entry custom_cast_module_entry = {
	STANDARD_MODULE_HEADER,
	"custom_cast",					/* Extension name */
	NULL,							/* zend_function_entry */
	PHP_MINIT(custom_cast),			/* PHP_MINIT - Module initialization */
	NULL,							/* PHP_MSHUTDOWN - Module shutdown */
	PHP_RINIT(custom_cast),			/* PHP_RINIT - Request initialization */
	NULL,							/* PHP_RSHUTDOWN - Request shutdown */
	PHP_MINFO(custom_cast),			/* PHP_MINFO - Module info */
	PHP_CUSTOM_CAST_VERSION,		/* Version */
	STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_CUSTOM_CAST
# ifdef ZTS
ZEND_TSRMLS_CACHE_DEFINE()
# endif
ZEND_GET_MODULE(custom_cast)
#endif
