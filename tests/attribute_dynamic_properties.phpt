--TEST--
Cannot add dynamic properties to `CustomCastable`
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CustomCastable;

$a = new CustomCastable();
try {
	$a->foo = true;
} catch (Error $e) {
	echo $e->getMessage() . PHP_EOL;
}
?>
--EXPECT--
Cannot create dynamic property CustomCasting\CustomCastable::$foo
