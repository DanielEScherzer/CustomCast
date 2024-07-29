--TEST--
Error when bool cast returns wrong type
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CastableTarget;
use CustomCasting\CustomCastable;

#[CustomCastable]
class Demo {

	public function __doCast(CastableTarget $t) {
		return 5;
	}

}

$d = new Demo();
var_dump( (bool)$d );

?>
--EXPECTF--
Fatal error: Method Demo::__doCast() did not return a boolean, got 5 in %s on line %d