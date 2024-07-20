--TEST--
Check that the `CustomCastable` attribute works (int casts)
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
class Demo {
	private int $val;
	public function __construct(
		int $val
	) {
		$this->val = $val;
	}

	public function __doCast(CastableTarget $t) {
		if ($t === CastableTarget::CAST_LONG) {
			return $this->val;
		}
	}

}

echo "5:\n";
$t = new Demo( 5 );
var_dump( $t );
var_dump( (int)$t );

echo "\n";

echo "-5:\n";
$f = new Demo( -5 );
var_dump( $f );
var_dump( (int)$f );

?>
--EXPECTF--
5:
object(Demo)#%d (1) {
  ["val":"Demo":private]=>
  int(5)
}
int(5)

-5:
object(Demo)#%d (1) {
  ["val":"Demo":private]=>
  int(-5)
}
int(-5)