--TEST--
Attribute parameter value is applied
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CustomCastable;

function exception_error_handler($severity, $message, $file, $line) {
	throw new ErrorException($message, 0, $severity, $file, $line);
}
set_error_handler("exception_error_handler");

function checkCase(string $name, int $target) {
	echo "Target = $name ($target):\n";
	$php = <<<END
<?php

use CustomCasting\CastableTarget;
use CustomCasting\CustomCastable;

#[CustomCastable($target)]
class Demo$target {
	public function __doCast(CastableTarget \$t) {
		echo 'Called for: ' . \$t->name . "\n";
		return match ( \$t ) {
			CastableTarget::CAST_BOOL => false,
			CastableTarget::CAST_FLOAT => 23.45,
			CastableTarget::CAST_LONG => 987,
		};
	}
}

\$d = new Demo$target();
try {
	var_dump( (bool)\$d );
} catch ( Throwable \$e ) {
	echo \$e->getMessage() . "\n";
}
try {
	var_dump( (float)\$d );
} catch ( Throwable \$e ) {
	echo \$e->getMessage() . "\n";
}
try {
	var_dump( (int)\$d );
} catch ( Throwable \$e ) {
	echo \$e->getMessage() . "\n";
}
END;

	file_put_contents( __DIR__ . '/generated.php', $php );
	include __DIR__ . '/generated.php';
	echo "\n";
}

$b = CustomCastable::TARGET_BOOL;
$f = CustomCastable::TARGET_FLOAT;
$l = CustomCastable::TARGET_LONG;
$cases = [
	'TARGET_BOOL' => $b,
	'TARGET_FLOAT' => $f,
	'TARGET_FLOAT | TARGET_BOOL' => $f | $b,
	'TARGET_LONG' => $l,
	'TARGET_LONG | TARGET_BOOL' => $l | $b,
	'TARGET_LONG | TARGET_FLOAT' => $l | $f,
	'TARGET_LONG | TARGET_FLOAT | TARGET_BOOL' => $l | $f | $b,
];
foreach ( $cases as $name => $target ) {
	checkCase( $name, $target );
}
?>
--CLEAN--
<?php
@unlink( __DIR__ . '/generated.php' );
?>
--EXPECT--
Target = TARGET_BOOL (1):
Called for: CAST_BOOL
bool(false)
Object of class Demo1 could not be converted to float
Object of class Demo1 could not be converted to int

Target = TARGET_FLOAT (2):
bool(true)
Called for: CAST_FLOAT
float(23.45)
Object of class Demo2 could not be converted to int

Target = TARGET_FLOAT | TARGET_BOOL (3):
Called for: CAST_BOOL
bool(false)
Called for: CAST_FLOAT
float(23.45)
Object of class Demo3 could not be converted to int

Target = TARGET_LONG (4):
bool(true)
Object of class Demo4 could not be converted to float
Called for: CAST_LONG
int(987)

Target = TARGET_LONG | TARGET_BOOL (5):
Called for: CAST_BOOL
bool(false)
Object of class Demo5 could not be converted to float
Called for: CAST_LONG
int(987)

Target = TARGET_LONG | TARGET_FLOAT (6):
bool(true)
Called for: CAST_FLOAT
float(23.45)
Called for: CAST_LONG
int(987)

Target = TARGET_LONG | TARGET_FLOAT | TARGET_BOOL (7):
Called for: CAST_BOOL
bool(false)
Called for: CAST_FLOAT
float(23.45)
Called for: CAST_LONG
int(987)