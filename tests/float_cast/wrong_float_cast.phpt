--TEST--
Error when float cast returns wrong type
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
class Demo {

	public function __doCast(CastableTarget $t) {
		return true;
	}

}

$d = new Demo();
var_dump( (float)$d );

?>
--EXPECTF--
Fatal error: Method Demo::__doCast() did not return a floating-point number in %s on line %d