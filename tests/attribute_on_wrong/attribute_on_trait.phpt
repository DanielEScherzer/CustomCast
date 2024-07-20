--TEST--
`CustomCastable` attribute cannot be added to a trait
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
trait Demo {
}

?>
--EXPECTF--
Fatal error: Cannot apply #[CustomCastable] to trait in %s on line %d