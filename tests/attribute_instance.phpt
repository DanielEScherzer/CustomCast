--TEST--
Create an instance of `CustomCastable`
--EXTENSIONS--
custom_cast
--FILE--
<?php

$a = new CustomCastable();
var_dump( $a );
?>
--EXPECT--
object(CustomCastable)#1 (0) {
}
