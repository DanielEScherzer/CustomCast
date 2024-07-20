--TEST--
`CastableTarget` enum has the correct cases
--EXTENSIONS--
custom_cast
--FILE--
<?php
var_dump(CastableTarget::cases());

foreach ( CastableTarget::cases() as $c ) {
  var_dump( $c->name );
}
?>
--EXPECT--
array(2) {
  [0]=>
  enum(CastableTarget::CAST_BOOL)
  [1]=>
  enum(CastableTarget::CAST_LONG)
}
string(9) "CAST_BOOL"
string(9) "CAST_LONG"