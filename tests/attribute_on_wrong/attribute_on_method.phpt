--TEST--
`CustomCastable` attribute cannot be added to a method
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CustomCastable;

class Demo {
	#[CustomCastable]
	function foo() {
	}
}

?>
--EXPECTF--
Fatal error: Attribute "CustomCasting\CustomCastable" cannot target method (allowed targets: class) in %s on line %d