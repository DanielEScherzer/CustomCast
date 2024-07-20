--TEST--
Check that the `CustomCastable` attribute doesn't change error messages
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
class WithAttrib {
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

class WithoutAttrib {

}

echo "With attribute:\n";
$w = new WithAttrib( true );
var_dump( (bool)$w );
var_dump( (int)$w );

echo "\n";
echo "Without:\n";
$n = new WithoutAttrib();
var_dump( (bool)$n );
var_dump( (int)$w );

?>
--EXPECTF--
With attribute:
bool(true)

Warning: Object of class WithAttrib could not be converted to int in %s on line %d
int(1)

Without:
bool(true)

Warning: Object of class WithAttrib could not be converted to int in %s on line %d
int(1)