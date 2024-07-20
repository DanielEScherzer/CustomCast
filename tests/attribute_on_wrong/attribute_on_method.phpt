--TEST--
`CustomCastable` attribute cannot be added to a method
--EXTENSIONS--
custom_cast
--FILE--
<?php
class Demo {
	#[CustomCastable]
	function foo() {
	}
}

?>
--EXPECTF--
Fatal error: Attribute "CustomCastable" cannot target method (allowed targets: class) in %s on line %d