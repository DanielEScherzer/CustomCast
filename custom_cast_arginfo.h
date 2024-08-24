/* This is a generated file, edit the .stub.php file instead.
 * Stub hash: bc6ece1b8783d2a7673d50c6fd0f28a0944c96c5 */

ZEND_BEGIN_ARG_INFO_EX(arginfo_class_CustomCasting_HasCustomCast___doCast, 0, 0, 1)
	ZEND_ARG_OBJ_INFO(0, t, CustomCasting\\CastableTarget, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_class_CustomCasting_CustomCastable___construct, 0, 0, 0)
	ZEND_ARG_TYPE_INFO_WITH_DEFAULT_VALUE(0, target, IS_LONG, 0, "CustomCasting\\CustomCastable::TARGET_ALL")
ZEND_END_ARG_INFO()


ZEND_METHOD(CustomCasting_CustomCastable, __construct);


static const zend_function_entry class_CustomCasting_CastableTarget_methods[] = {
	ZEND_FE_END
};


static const zend_function_entry class_CustomCasting_HasCustomCast_methods[] = {
	ZEND_ABSTRACT_ME_WITH_FLAGS(CustomCasting_HasCustomCast, __doCast, arginfo_class_CustomCasting_HasCustomCast___doCast, ZEND_ACC_PUBLIC|ZEND_ACC_ABSTRACT)
	ZEND_FE_END
};


static const zend_function_entry class_CustomCasting_CustomCastable_methods[] = {
	ZEND_ME(CustomCasting_CustomCastable, __construct, arginfo_class_CustomCasting_CustomCastable___construct, ZEND_ACC_PUBLIC)
	ZEND_FE_END
};

static zend_class_entry *register_class_CustomCasting_CastableTarget(void)
{
	zend_class_entry *class_entry = zend_register_internal_enum("CustomCasting\\CastableTarget", IS_UNDEF, class_CustomCasting_CastableTarget_methods);

	zend_enum_add_case_cstr(class_entry, "CAST_BOOL", NULL);

	zend_enum_add_case_cstr(class_entry, "CAST_FLOAT", NULL);

	zend_enum_add_case_cstr(class_entry, "CAST_LONG", NULL);

	return class_entry;
}

static zend_class_entry *register_class_CustomCasting_HasCustomCast(void)
{
	zend_class_entry ce, *class_entry;

	INIT_NS_CLASS_ENTRY(ce, "CustomCasting", "HasCustomCast", class_CustomCasting_HasCustomCast_methods);
	class_entry = zend_register_internal_interface(&ce);

	return class_entry;
}

static zend_class_entry *register_class_CustomCasting_CustomCastable(void)
{
	zend_class_entry ce, *class_entry;

	INIT_NS_CLASS_ENTRY(ce, "CustomCasting", "CustomCastable", class_CustomCasting_CustomCastable_methods);
	class_entry = zend_register_internal_class_ex(&ce, NULL);
	class_entry->ce_flags |= ZEND_ACC_FINAL|ZEND_ACC_NO_DYNAMIC_PROPERTIES;

	zval const_TARGET_BOOL_value;
	ZVAL_LONG(&const_TARGET_BOOL_value, 1);
	zend_string *const_TARGET_BOOL_name = zend_string_init_interned("TARGET_BOOL", sizeof("TARGET_BOOL") - 1, 1);
	zend_declare_typed_class_constant(class_entry, const_TARGET_BOOL_name, &const_TARGET_BOOL_value, ZEND_ACC_PUBLIC, NULL, (zend_type) ZEND_TYPE_INIT_MASK(MAY_BE_LONG));
	zend_string_release(const_TARGET_BOOL_name);

	zval const_TARGET_FLOAT_value;
	ZVAL_LONG(&const_TARGET_FLOAT_value, 2);
	zend_string *const_TARGET_FLOAT_name = zend_string_init_interned("TARGET_FLOAT", sizeof("TARGET_FLOAT") - 1, 1);
	zend_declare_typed_class_constant(class_entry, const_TARGET_FLOAT_name, &const_TARGET_FLOAT_value, ZEND_ACC_PUBLIC, NULL, (zend_type) ZEND_TYPE_INIT_MASK(MAY_BE_LONG));
	zend_string_release(const_TARGET_FLOAT_name);

	zval const_TARGET_LONG_value;
	ZVAL_LONG(&const_TARGET_LONG_value, 4);
	zend_string *const_TARGET_LONG_name = zend_string_init_interned("TARGET_LONG", sizeof("TARGET_LONG") - 1, 1);
	zend_declare_typed_class_constant(class_entry, const_TARGET_LONG_name, &const_TARGET_LONG_value, ZEND_ACC_PUBLIC, NULL, (zend_type) ZEND_TYPE_INIT_MASK(MAY_BE_LONG));
	zend_string_release(const_TARGET_LONG_name);

	zval const_TARGET_ALL_value;
	ZVAL_LONG(&const_TARGET_ALL_value, 7);
	zend_string *const_TARGET_ALL_name = zend_string_init_interned("TARGET_ALL", sizeof("TARGET_ALL") - 1, 1);
	zend_declare_typed_class_constant(class_entry, const_TARGET_ALL_name, &const_TARGET_ALL_value, ZEND_ACC_PUBLIC, NULL, (zend_type) ZEND_TYPE_INIT_MASK(MAY_BE_LONG));
	zend_string_release(const_TARGET_ALL_name);

	zval property_target_default_value;
	ZVAL_UNDEF(&property_target_default_value);
	zend_string *property_target_name = zend_string_init("target", sizeof("target") - 1, 1);
	zend_declare_typed_property(class_entry, property_target_name, &property_target_default_value, ZEND_ACC_PRIVATE, NULL, (zend_type) ZEND_TYPE_INIT_MASK(MAY_BE_LONG));
	zend_string_release(property_target_name);

	return class_entry;
}
