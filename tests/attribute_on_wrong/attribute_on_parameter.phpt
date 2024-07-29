--TEST--
`CustomCastable` attribute cannot be added to a parameter
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CustomCastable;

class Demo {
	public function foo(
		#[CustomCastable] $bar
	) {
	}
}

?>
--EXPECTF--
Fatal error: Attribute "CustomCasting\CustomCastable" cannot target parameter (allowed targets: class) in %s on line %d