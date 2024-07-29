--TEST--
`CustomCastable` attribute cannot be added to a property
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CustomCastable;

class Demo {
	#[CustomCastable]
	public $foo;
}

?>
--EXPECTF--
Fatal error: Attribute "CustomCasting\CustomCastable" cannot target property (allowed targets: class) in %s on line %d