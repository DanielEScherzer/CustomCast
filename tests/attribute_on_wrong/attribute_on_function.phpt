--TEST--
`CustomCastable` attribute cannot be added to a function
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
function demo() {
}

?>
--EXPECTF--
Fatal error: Attribute "CustomCastable" cannot target function (allowed targets: class) in %s on line %d