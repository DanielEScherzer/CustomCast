--TEST--
`CastableTarget` enum is not backed
--EXTENSIONS--
custom_cast
--FILE--
<?php
$ref = new ReflectionEnum(CastableTarget::class);
var_dump($ref->isBacked());

?>
--EXPECT--
bool(false)