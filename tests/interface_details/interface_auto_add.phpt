--TEST--
`HasCustomCast` interface is automatically added based on `CustomCastable`
--EXTENSIONS--
custom_cast
--FILE--
<?php
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
string(13) "HasCustomCast"