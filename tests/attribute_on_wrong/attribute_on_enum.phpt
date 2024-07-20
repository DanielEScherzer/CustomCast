--TEST--
`CustomCastable` attribute cannot be added to an enum
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
enum Demo {
}

?>
--EXPECTF--
Fatal error: Cannot apply #[CustomCastable] to enum in %s on line %d