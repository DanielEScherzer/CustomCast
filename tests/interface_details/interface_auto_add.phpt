--TEST--
`HasCustomCast` interface is automatically added based on `CustomCastable`
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
foreach ( $demoRef->getInterfaces() as $i ) {
	var_dump( $i->getName() );
}

?>
--EXPECT--
string(27) "CustomCasting\HasCustomCast"