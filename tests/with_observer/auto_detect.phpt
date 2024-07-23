--TEST--
`HasCustomCast` interface and custom object handlers automatically added by the observer
--EXTENSIONS--
custom_cast
--INI--
custom_cast.use_observer=true
--FILE--
<?php
class Demo {
	public function __doCast(CastableTarget $t) {
		switch ($t) {
			case CastableTarget::CAST_BOOL:
				return false;
			case CastableTarget::CAST_FLOAT:
				return 23.45;
			case CastableTarget::CAST_LONG:
				return 987;
		}
	}

}

$demoRef = new ReflectionClass('Demo');
foreach ( $demoRef->getInterfaces() as $i ) {
	var_dump( $i->getName() );
}

$demo = new Demo();
var_dump( (bool)$demo );
var_dump( (float)$demo );
var_dump( (int)$demo );

?>
--EXPECT--
string(13) "HasCustomCast"
bool(false)
float(23.45)
int(987)