--TEST--
`HasCustomCast` interface can also be added manually
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CastableTarget;
use CustomCasting\CustomCastable;
use CustomCasting\HasCustomCast;

#[CustomCastable]
class Demo implements HasCustomCast {
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