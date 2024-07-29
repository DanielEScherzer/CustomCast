--TEST--
`CustomCastable` attribute cannot be added to an enum
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CustomCastable;

#[CustomCastable]
enum Demo {
}

?>
--EXPECTF--
Fatal error: Cannot apply #[CustomCasting\CustomCastable] to enum in %s on line %d