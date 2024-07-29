/* This is a generated file, edit the .stub.php file instead.
 * Stub hash: 57ed665deb1d24b17a79bc7359b544b2bcdaeb20 */

ZEND_BEGIN_ARG_INFO_EX(arginfo_class_CustomCasting_HasCustomCast___doCast, 0, 0, 1)
	ZEND_ARG_OBJ_INFO(0, t, CustomCasting\\CastableTarget, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_class_CustomCasting_CustomCastable___construct, 0, 0, 0)
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
	class_entry->ce_flags |= ZEND_ACC_FINAL;

	return class_entry;
}
