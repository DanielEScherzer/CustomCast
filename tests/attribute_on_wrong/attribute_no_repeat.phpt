--TEST--
`CustomCastable` attribute cannot be repeated
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CustomCastable;

#[CustomCastable]
#[CustomCastable]
Interface Demo {

}

?>
--EXPECTF--
Fatal error: Attribute "CustomCasting\CustomCastable" must not be repeated in %s on line %d
