/* phpext extension for PHP */

#ifndef PHP_PHPEXT_H
# define PHP_PHPEXT_H

extern zend_module_entry phpext_module_entry;
# define phpext_phpext_ptr &phpext_module_entry

# define PHP_PHPEXT_VERSION "0.1.0"

# if defined(ZTS) && defined(COMPILE_DL_PHPEXT)
ZEND_TSRMLS_CACHE_EXTERN()
# endif

#endif	/* PHP_PHPEXT_H */
