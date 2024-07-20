--TEST--
`HasCustomCast` interface can also be added manually
--EXTENSIONS--
custom_cast
--FILE--
<?php
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
string(13) "HasCustomCast"