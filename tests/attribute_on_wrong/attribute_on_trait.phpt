--TEST--
`CustomCastable` attribute cannot be added to a trait
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CustomCastable;

#[CustomCastable]
trait Demo {
}

?>
--EXPECTF--
Fatal error: Cannot apply #[CustomCasting\CustomCastable] to trait in %s on line %d