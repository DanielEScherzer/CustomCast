--TEST--
`CustomCastable` attribute cannot be repeated
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
#[CustomCastable]
Interface Demo {

}

?>
--EXPECTF--
Fatal error: Attribute "CustomCastable" must not be repeated in %s on line %d
