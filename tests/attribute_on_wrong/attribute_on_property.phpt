--TEST--
`CustomCastable` attribute cannot be added to a property
--EXTENSIONS--
custom_cast
--FILE--
<?php
class Demo {
	#[CustomCastable]
	public $foo;
}

?>
--EXPECTF--
Fatal error: Attribute "CustomCastable" cannot target property (allowed targets: class) in %s on line %d