/* custom_cast extension for PHP */

#ifndef PHP_CUSTOM_CAST_H
# define PHP_CUSTOM_CAST_H

extern zend_module_entry custom_cast_module_entry;
# define phpext_custom_cast_ptr &custom_cast_module_entry

# define PHP_CUSTOM_CAST_VERSION "0.1.0"

// Support for using the observer system
ZEND_BEGIN_MODULE_GLOBALS(custom_cast)
	bool use_observer;
ZEND_END_MODULE_GLOBALS(custom_cast)

ZEND_DECLARE_MODULE_GLOBALS(custom_cast)
#define CUSTOM_CAST_G(v) ZEND_MODULE_GLOBALS_ACCESSOR(custom_cast, v)

# if defined(ZTS) && defined(COMPILE_DL_CUSTOM_CAST)
ZEND_TSRMLS_CACHE_EXTERN()
# endif

#endif	/* PHP_CUSTOM_CAST_H */
