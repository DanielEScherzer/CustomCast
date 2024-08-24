--TEST--
Attribute parameter must be in [1,7]
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CustomCastable;

echo "Default\n";
var_dump( new CustomCastable() );

for ( $iii = 1; $iii <= 7; $iii++ ) {
	echo "No error with target = $iii\n";
	var_dump( new CustomCastable( $iii ) );
	echo "Named argument, target = $iii\n";
	var_dump( new CustomCastable( target: $iii ) );
}
try {
	new CustomCastable( 0 );
} catch ( ValueError $e ) {
	echo $e->getMessage() . "\n";
}

try {
	new CustomCastable( 8 );
} catch ( ValueError $e ) {
	echo $e->getMessage() . "\n";
}

?>
--EXPECT--
Default
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(7)
}
No error with target = 1
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(1)
}
Named argument, target = 1
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(1)
}
No error with target = 2
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(2)
}
Named argument, target = 2
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(2)
}
No error with target = 3
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(3)
}
Named argument, target = 3
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(3)
}
No error with target = 4
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(4)
}
Named argument, target = 4
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(4)
}
No error with target = 5
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(5)
}
Named argument, target = 5
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(5)
}
No error with target = 6
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(6)
}
Named argument, target = 6
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(6)
}
No error with target = 7
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(7)
}
Named argument, target = 7
object(CustomCasting\CustomCastable)#1 (1) {
  ["target":"CustomCasting\CustomCastable":private]=>
  int(7)
}
CustomCasting\CustomCastable::__construct(): Argument #1 ($target) must be greater than 0
CustomCasting\CustomCastable::__construct(): Argument #1 ($target) must be at most 7 (CustomCastable::TARGET_ALL)