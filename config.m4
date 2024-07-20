dnl config.m4 for extension custom_cast

dnl Comments in this file start with the string 'dnl'.
dnl Remove where necessary.

dnl If your extension references something external, use 'with':

dnl PHP_ARG_WITH([custom_cast],
dnl   [for custom_cast support],
dnl   [AS_HELP_STRING([--with-custom_cast],
dnl     [Include custom_cast support])])

dnl Otherwise use 'enable':

PHP_ARG_ENABLE([custom_cast],
  [whether to enable custom_cast support],
  [AS_HELP_STRING([--enable-custom_cast],
    [Enable custom_cast support])],
  [no])

if test "$PHP_CUSTOM_CAST" != "no"; then
  dnl Write more examples of tests here...

  dnl Remove this code block if the library does not support pkg-config.
  dnl PKG_CHECK_MODULES([LIBFOO], [foo])
  dnl PHP_EVAL_INCLINE($LIBFOO_CFLAGS)
  dnl PHP_EVAL_LIBLINE($LIBFOO_LIBS, CUSTOM_CAST_SHARED_LIBADD)

  dnl If you need to check for a particular library version using PKG_CHECK_MODULES,
  dnl you can use comparison operators. For example:
  dnl PKG_CHECK_MODULES([LIBFOO], [foo >= 1.2.3])
  dnl PKG_CHECK_MODULES([LIBFOO], [foo < 3.4])
  dnl PKG_CHECK_MODULES([LIBFOO], [foo = 1.2.3])

  dnl Remove this code block if the library supports pkg-config.
  dnl --with-custom_cast -> check with-path
  dnl SEARCH_PATH="/usr/local /usr"     # you might want to change this
  dnl SEARCH_FOR="/include/custom_cast.h"  # you most likely want to change this
  dnl if test -r $PHP_CUSTOM_CAST/$SEARCH_FOR; then # path given as parameter
  dnl   CUSTOM_CAST_DIR=$PHP_CUSTOM_CAST
  dnl else # search default path list
  dnl   AC_MSG_CHECKING([for custom_cast files in default path])
  dnl   for i in $SEARCH_PATH ; do
  dnl     if test -r $i/$SEARCH_FOR; then
  dnl       CUSTOM_CAST_DIR=$i
  dnl       AC_MSG_RESULT(found in $i)
  dnl     fi
  dnl   done
  dnl fi
  dnl
  dnl if test -z "$CUSTOM_CAST_DIR"; then
  dnl   AC_MSG_RESULT([not found])
  dnl   AC_MSG_ERROR([Please reinstall the custom_cast distribution])
  dnl fi

  dnl Remove this code block if the library supports pkg-config.
  dnl --with-custom_cast -> add include path
  dnl PHP_ADD_INCLUDE($CUSTOM_CAST_DIR/include)

  dnl Remove this code block if the library supports pkg-config.
  dnl --with-custom_cast -> check for lib and symbol presence
  dnl LIBNAME=CUSTOM_CAST # you may want to change this
  dnl LIBSYMBOL=CUSTOM_CAST # you most likely want to change this

  dnl If you need to check for a particular library function (e.g. a conditional
  dnl or version-dependent feature) and you are using pkg-config:
  dnl PHP_CHECK_LIBRARY($LIBNAME, $LIBSYMBOL,
  dnl [
  dnl   AC_DEFINE(HAVE_CUSTOM_CAST_FEATURE, 1, [ ])
  dnl ],[
  dnl   AC_MSG_ERROR([FEATURE not supported by your custom_cast library.])
  dnl ], [
  dnl   $LIBFOO_LIBS
  dnl ])

  dnl If you need to check for a particular library function (e.g. a conditional
  dnl or version-dependent feature) and you are not using pkg-config:
  dnl PHP_CHECK_LIBRARY($LIBNAME, $LIBSYMBOL,
  dnl [
  dnl   PHP_ADD_LIBRARY_WITH_PATH($LIBNAME, $CUSTOM_CAST_DIR/$PHP_LIBDIR, CUSTOM_CAST_SHARED_LIBADD)
  dnl   AC_DEFINE(HAVE_CUSTOM_CAST_FEATURE, 1, [ ])
  dnl ],[
  dnl   AC_MSG_ERROR([FEATURE not supported by your custom_cast library.])
  dnl ],[
  dnl   -L$CUSTOM_CAST_DIR/$PHP_LIBDIR -lm
  dnl ])
  dnl
  dnl PHP_SUBST(CUSTOM_CAST_SHARED_LIBADD)

  dnl In case of no dependencies
  AC_DEFINE(HAVE_CUSTOM_CAST, 1, [ Have custom_cast support ])

  PHP_NEW_EXTENSION(custom_cast, custom_cast.c, $ext_shared)
fi
