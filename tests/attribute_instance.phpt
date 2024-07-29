--TEST--
Create an instance of `CustomCastable`
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CustomCastable;

$a = new CustomCastable();
var_dump( $a );
?>
--EXPECT--
object(CustomCasting\CustomCastable)#1 (0) {
}
