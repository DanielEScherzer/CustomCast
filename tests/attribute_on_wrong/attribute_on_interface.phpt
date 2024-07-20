--TEST--
`CustomCastable` attribute cannot be added to an interface
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
interface Demo {
}

?>
--EXPECTF--
Fatal error: Cannot apply #[CustomCastable] to interface in %s on line %d
