--TEST--
Custom casting on parent classes gets inherited
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CastableTarget;
use CustomCasting\CustomCastable;

#[CustomCastable]
class Demo {
	public function __doCast(CastableTarget $t) {
		return 777;
	}

}

class NoCast extends Demo {}

class OverrideCast extends Demo {
	public function __doCast(CastableTarget $t) {
		return 888;
	}
}

$noCastRef = new ReflectionClass('NoCast');
foreach ( $noCastRef->getInterfaces() as $i ) {
	var_dump( $i->getName() );
}

$noCast = new Demo();
var_dump((int)$noCast);

$override = new OverrideCast();
var_dump((int)$override);

?>
--EXPECTF--
string(27) "CustomCasting\HasCustomCast"
int(777)
int(888)
