--TEST--
Check that the `CustomCastable` class exists
--EXTENSIONS--
custom_cast
--FILE--
<?php
var_dump(class_exists('CustomCastable'));
?>
--EXPECT--
bool(true)
