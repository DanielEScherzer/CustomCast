--TEST--
`HasCustomCast` interface explicitly declared is also inherited
--DESCRIPTION--
The interface and functionality is inherited also when the interface was
manually added.
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
		return 777;
	}

}

#[CustomCastable]
class Demo2 extends Demo {}

#[CustomCastable]
class Demo3 extends Demo {
	public function __doCast(CastableTarget $t) {
		return 888;
	}
}

$demo2Ref = new ReflectionClass('Demo2');
foreach ( $demo2Ref->getInterfaces() as $i ) {
	var_dump( $i->getName() );
}

$demo2 = new Demo2();
var_dump((int)$demo2);

$demo3 = new Demo3();
var_dump((int)$demo3);

?>
--EXPECT--
string(27) "CustomCasting\HasCustomCast"
int(777)
int(888)