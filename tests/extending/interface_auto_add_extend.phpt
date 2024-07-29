--TEST--
`HasCustomCast` interface can be declared in subclasses without conflicts
--DESCRIPTION--
Not only is the functionality inherited, but the interface is too (as normal)
but can also can also be inherited; if the subclass has the attribute, there are
no conflicts.
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