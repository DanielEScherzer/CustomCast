--TEST--
`HasCustomCast` interface can also be inherited, if the subclass has the attribute,
and more importantly, the custom cast logic still works works (though the attribute
needs to be on BOTH the parent and subclass, at least for now)
--EXTENSIONS--
custom_cast
--FILE--
<?php
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
string(13) "HasCustomCast"
int(777)
int(888)