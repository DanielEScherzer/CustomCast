--TEST--
__doCast() can throw exceptions that get shown
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CastableTarget;
use CustomCasting\CustomCastable;

#[CustomCastable]
class Demo {
	public function __doCast(CastableTarget $t) {
		throw new RuntimeException(
			"Cannot convert to " . $t->name
		);
	}
	public function __toString() {
		throw new RuntimeException( "Cannot convert to string" );
	}
}

$d = new Demo();

try {
	var_dump( (string)$d );
} catch (RuntimeException $e) {
	echo "Caught: " . $e->getMessage() . PHP_EOL;
}

try {
	var_dump( (int)$d );
} catch (RuntimeException $e) {
	echo "Caught: " . $e->getMessage() . PHP_EOL;
}

try {
	var_dump( (float)$d );
} catch (RuntimeException $e) {
	echo "Caught: " . $e->getMessage() . PHP_EOL;
}

try {
	var_dump( (bool)$d );
} catch (RuntimeException $e) {
	echo "Caught: " . $e->getMessage() . PHP_EOL;
}


?>
--EXPECT--
Caught: Cannot convert to string
Caught: Cannot convert to CAST_LONG
Caught: Cannot convert to CAST_FLOAT
Caught: Cannot convert to CAST_BOOL