--TEST--
Error when int cast returns wrong type
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
var_dump( (int)$d );

?>
--EXPECTF--
Fatal error: Method Demo::__doCast() did not return an integer in %s on line %d