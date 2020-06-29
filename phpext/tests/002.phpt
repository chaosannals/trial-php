--TEST--
phpext_test1() Basic test
--SKIPIF--
<?php
if (!extension_loaded('phpext')) {
	echo 'skip';
}
?>
--FILE--
<?php
$ret = phpext_test1();

var_dump($ret);
?>
--EXPECT--
The extension phpext is loaded and working!
NULL
