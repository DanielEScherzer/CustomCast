--TEST--
`CastableTarget` enum exists
--EXTENSIONS--
custom_cast
--FILE--
<?php
var_dump(class_exists('CustomCasting\\CastableTarget'));
var_dump(enum_exists('CustomCasting\\CastableTarget'));
?>
--EXPECT--
bool(true)
bool(true)
