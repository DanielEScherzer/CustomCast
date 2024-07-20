--TEST--
Check that the `CustomCastable` attribute isn't causing issues
"Internal zval's can't be arrays, objects, resources or reference"
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
class Demo {
    public function __doCast(CastableTarget $t) {
	}

}

$d = new Demo();
var_dump( (bool)$d );
var_dump( (int)$d );

?>
--EXPECTF--
bool(true)

Warning: Object of class Demo could not be converted to int in %s on line %d
int(1)
