--TEST--
Custom casting doesn't change error messages for missing return values
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
class WithAttrib {
    public function __doCast(CastableTarget $t) {}
}

class WithoutAttrib {}

echo "With attribute:\n";
$w = new WithAttrib();
var_dump( (bool)$w );
var_dump( (float)$w );
var_dump( (int)$w );

echo "\n";
echo "Without:\n";
$n = new WithoutAttrib();
var_dump( (bool)$n );
var_dump( (float)$n );
var_dump( (int)$w );

?>
--EXPECTF--
With attribute:
bool(true)

Warning: Object of class WithAttrib could not be converted to float in %s on line %d
float(1)

Warning: Object of class WithAttrib could not be converted to int in %s on line %d
int(1)

Without:
bool(true)

Warning: Object of class WithoutAttrib could not be converted to float in %s on line %d
float(1)

Warning: Object of class WithAttrib could not be converted to int in %s on line %d
int(1)