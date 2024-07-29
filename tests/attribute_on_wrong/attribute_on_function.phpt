--TEST--
`CustomCastable` attribute cannot be added to a function
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CustomCastable;

#[CustomCastable]
function demo() {
}

?>
--EXPECTF--
Fatal error: Attribute "CustomCasting\CustomCastable" cannot target function (allowed targets: class) in %s on line %d