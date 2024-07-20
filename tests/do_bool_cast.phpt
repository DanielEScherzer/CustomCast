--TEST--
Check that the `CustomCastable` attribute works (bool casts)
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
class Demo {
	private bool $val;
	public function __construct(
		bool $val
	) {
		$this->val = $val;
	}

	public function __doCast(CastableTarget $t) {
		if ($t === CastableTarget::CAST_BOOL) {
			return $this->val;
		}
	}

}

echo "True:\n";
$t = new Demo( true );
var_dump( $t );
var_dump( (bool)$t );

echo "\n";

echo "False:\n";
$f = new Demo( false );
var_dump( $f );
var_dump( (bool)$f );

?>
--EXPECTF--
True:
object(Demo)#%d (1) {
  ["val":"Demo":private]=>
  bool(true)
}
bool(true)

False:
object(Demo)#%d (1) {
  ["val":"Demo":private]=>
  bool(false)
}
bool(false)