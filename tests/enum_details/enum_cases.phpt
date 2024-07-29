--TEST--
`CastableTarget` enum has the correct cases
--EXTENSIONS--
custom_cast
--FILE--
<?php

use CustomCasting\CastableTarget;

var_dump(CastableTarget::cases());

foreach ( CastableTarget::cases() as $c ) {
  var_dump( $c->name );
}
?>
--EXPECT--
array(3) {
  [0]=>
  enum(CustomCasting\CastableTarget::CAST_BOOL)
  [1]=>
  enum(CustomCasting\CastableTarget::CAST_FLOAT)
  [2]=>
  enum(CustomCasting\CastableTarget::CAST_LONG)
}
string(9) "CAST_BOOL"
string(10) "CAST_FLOAT"
string(9) "CAST_LONG"