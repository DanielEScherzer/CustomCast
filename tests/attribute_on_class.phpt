--TEST--
Check that the `CustomCastable` attribute can be added to a class
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CastableTarget;
use CustomCasting\CustomCastable;

#[CustomCastable]
class Demo {
	public function __doCast(CastableTarget $t) {
	}

}

$demoRef = new ReflectionClass('Demo');
foreach ( $demoRef->getAttributes() as $a ) {
	var_dump( $a->getName() );
}

?>
--EXPECT--
string(28) "CustomCasting\CustomCastable"
