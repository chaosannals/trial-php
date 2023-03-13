/* phpext extension for PHP */

#ifdef HAVE_CONFIG_H
# include "config.h"
#endif

#include "php.h"
#include "ext/standard/info.h"
#include "php_phpext.h"

/* For compatibility with older PHP versions */
#ifndef ZEND_PARSE_PARAMETERS_NONE
#define ZEND_PARSE_PARAMETERS_NONE() \
	ZEND_PARSE_PARAMETERS_START(0, 0) \
	ZEND_PARSE_PARAMETERS_END()
#endif

/* 类定义 */
zend_class_entry *tester_ce;

ZEND_BEGIN_ARG_INFO_EX(arginfo_tester_ctor, 0, 0, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_tester_test, 0, 0, 1)
	ZEND_ARG_INFO(0, hello)
ZEND_END_ARG_INFO()

PHP_METHOD(tester, __construct)
{
	zend_update_property_string(tester_ce,  getThis(), "memory", sizeof("memory") - 1, "tester-memory");
}

PHP_METHOD(tester, test)
{
	zend_string *hello = NULL;
	if (zend_parse_parameters(ZEND_NUM_ARGS(), "S",  &hello) == FAILURE) {
		return;
	}
}

const zend_function_entry tester_methods[] = {
	PHP_ME(tester, __construct, arginfo_tester_ctor, ZEND_ACC_PUBLIC)
	PHP_ME(tester, test, arginfo_tester_test, ZEND_ACC_PUBLIC)
	{NULL, NULL, NULL}
};

/* {{{ void phpext_test1()
 */
PHP_FUNCTION(phpext_test1)
{
	ZEND_PARSE_PARAMETERS_NONE();

	php_printf("The extension %s is loaded and test1!\r\n", "phpext");
}
/* }}} */

/* {{{ string phpext_test2( [ string $var ] )
 */
PHP_FUNCTION(phpext_test2)
{
	char *var = "World";
	size_t var_len = sizeof("World") - 1;
	zend_string *retval;

	ZEND_PARSE_PARAMETERS_START(0, 1)
		Z_PARAM_OPTIONAL
		Z_PARAM_STRING(var, var_len)
	ZEND_PARSE_PARAMETERS_END();

	retval = strpprintf(0, "Hello %s", var);

	RETURN_STR(retval);
}
/* }}}*/

/* {{{ PHP_RINIT_FUNCTION
 */
PHP_RINIT_FUNCTION(phpext)
{
#if defined(ZTS) && defined(COMPILE_DL_PHPEXT)
	ZEND_TSRMLS_CACHE_UPDATE();
#endif

	return SUCCESS;
}
/* }}} */

PHP_MINIT_FUNCTION(phpext)
{
	zend_class_entry ce;
	INIT_CLASS_ENTRY(ce, "Tester", tester_methods);
	tester_ce = zend_register_internal_class(&ce);
	zend_declare_property_null(tester_ce, "memory", sizeof("memory") - 1, ZEND_ACC_PUBLIC);
	return SUCCESS;
}

/* {{{ PHP_MINFO_FUNCTION
 */
PHP_MINFO_FUNCTION(phpext)
{
	php_info_print_table_start();
	php_info_print_table_header(2, "phpext support", "enabled");
	php_info_print_table_end();
}
/* }}} */

/* {{{ arginfo
 */
ZEND_BEGIN_ARG_INFO(arginfo_phpext_test1, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO(arginfo_phpext_test2, 0)
	ZEND_ARG_INFO(0, str)
ZEND_END_ARG_INFO()
/* }}} */

/* {{{ phpext_functions[]
 */
static const zend_function_entry phpext_functions[] = {
	PHP_FE(phpext_test1,		arginfo_phpext_test1)
	PHP_FE(phpext_test2,		arginfo_phpext_test2)
	PHP_FE_END
};
/* }}} */

/* {{{ phpext_module_entry
 */
zend_module_entry phpext_module_entry = {
	STANDARD_MODULE_HEADER,
	"phpext",					/* Extension name */
	phpext_functions,			/* zend_function_entry */
	PHP_MINIT(phpext),							/* PHP_MINIT - Module initialization */
	NULL,							/* PHP_MSHUTDOWN - Module shutdown */
	PHP_RINIT(phpext),			/* PHP_RINIT - Request initialization */
	NULL,							/* PHP_RSHUTDOWN - Request shutdown */
	PHP_MINFO(phpext),			/* PHP_MINFO - Module info */
	PHP_PHPEXT_VERSION,		/* Version */
	STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_PHPEXT
# ifdef ZTS
ZEND_TSRMLS_CACHE_DEFINE()
# endif
ZEND_GET_MODULE(phpext)
#endif
