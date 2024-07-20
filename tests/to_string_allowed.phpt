--TEST--
Check that the `CustomCastable` attribute doesn't conflict with __toString()
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

	public function __doCast(CastableTarget $t): mixed {
		if ($t === CastableTarget::CAST_BOOL) {
			return $this->val;
		}
	}

	public function __toString() {
		return "5";
	}

}

echo "True:\n";
$t = new Demo( true );
var_dump( $t );
var_dump( (bool)$t );
var_dump( (string)$t );

echo "\n";

echo "False:\n";
$f = new Demo( false );
var_dump( $f );
var_dump( (bool)$f );
var_dump( (string)$f );

?>
--EXPECTF--
True:
object(Demo)#%d (1) {
  ["val":"Demo":private]=>
  bool(true)
}
bool(true)
string(1) "5"

False:
object(Demo)#%d (1) {
  ["val":"Demo":private]=>
  bool(false)
}
bool(false)
string(1) "5"