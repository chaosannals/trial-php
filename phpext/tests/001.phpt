--TEST--
Check if phpext is loaded
--SKIPIF--
<?php
if (!extension_loaded('phpext')) {
	echo 'skip';
}
?>
--FILE--
<?php
echo 'The extension "phpext" is available';
?>
--EXPECT--
The extension "phpext" is available
