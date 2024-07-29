--TEST--
Check that the `CustomCastable` attribute works (float casts)
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CastableTarget;
use CustomCasting\CustomCastable;

#[CustomCastable]
class Demo {
	private float $val;
	public function __construct(
		float $val
	) {
		$this->val = $val;
	}

	public function __doCast(CastableTarget $t) {
		if ($t === CastableTarget::CAST_FLOAT) {
			return $this->val;
		}
	}

}

echo "5.123:\n";
$t = new Demo( 5.123 );
var_dump( $t );
var_dump( (float)$t );

echo "\n";

echo "-5.987:\n";
$f = new Demo( -5.987 );
var_dump( $f );
var_dump( (float)$f );

?>
--EXPECTF--
5.123:
object(Demo)#%d (1) {
  ["val":"Demo":private]=>
  float(5.123)
}
float(5.123)

-5.987:
object(Demo)#%d (1) {
  ["val":"Demo":private]=>
  float(-5.987)
}
float(-5.987)