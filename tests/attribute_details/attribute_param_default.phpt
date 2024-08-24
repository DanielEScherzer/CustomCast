--TEST--
Attribute takes a single integer that defaults to TARGET_ALL
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CustomCastable;

$ref = new ReflectionClass(CustomCastable::class);
$constructor = $ref->getConstructor();
$params = $constructor->getParameters();
var_dump( count( $params ) );
$targetParam = $params[0];
var_dump( $targetParam->getName() );
var_dump( $targetParam->getDefaultValue() );
var_dump( CustomCastable::TARGET_ALL );
?>
--EXPECT--
int(1)
string(6) "target"
int(7)
int(7)
