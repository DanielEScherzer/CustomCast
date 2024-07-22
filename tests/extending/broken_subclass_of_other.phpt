--TEST--
Custom casting can be added to the children of non-custom-casting parent classes;
currently not supported but this test will help confirm if that ever changes
--EXTENSIONS--
custom_cast
--FILE--
<?php
class NoCast {}

#[CustomCastable]
class Demo extends NoCast {
	public function __doCast(CastableTarget $t) {
		return 777;
	}

}

$demo2Ref = new ReflectionClass('Demo');
foreach ( $demo2Ref->getInterfaces() as $i ) {
	var_dump( $i->getName() );
}

$demo = new Demo();
var_dump((int)$demo);

?>
--EXPECTF--
string(13) "HasCustomCast"

Warning: Object of class Demo could not be converted to int in %s on line %d
int(1)