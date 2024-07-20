--TEST--
`CastableTarget` enum exists
--EXTENSIONS--
custom_cast
--FILE--
<?php
var_dump(class_exists('CastableTarget'));
var_dump(enum_exists('CastableTarget'));
?>
--EXPECT--
bool(true)
bool(true)
