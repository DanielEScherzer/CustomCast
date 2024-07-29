--TEST--
When a custom castable object is implicitly cast to bool the extension still intercepts
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CastableTarget;
use CustomCasting\CustomCastable;

#[CustomCastable]
class MyBool {
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

function testBool(MyBool $bool) {
	if ( $bool ) {
		echo "If(): true\n";
	} else {
		echo "If(): false\n";
	}

	echo ( $bool ? "Ternary: true\n" : "Ternary: false\n" );

	$invert = !$bool;
	echo "With a !: ";
	var_export( $invert );
}

echo "True:\n";
$t = new MyBool( true );
testBool( $t );

echo "\n\n";

echo "False:\n";
$f = new MyBool( false );
testBool( $f );

?>
--EXPECT--
True:
If(): true
Ternary: true
With a !: false

False:
If(): false
Ternary: false
With a !: true