--TEST--
`CustomCastable` attribute cannot be added to a parameter
--EXTENSIONS--
custom_cast
--FILE--
<?php
class Demo {
	public function foo(
		#[CustomCastable] $bar
	) {
	}
}

?>
--EXPECTF--
Fatal error: Attribute "CustomCastable" cannot target parameter (allowed targets: class) in %s on line %d