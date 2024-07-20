--TEST--
`CustomCastable` attribute requires __doCast()
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
class Demo {
}

?>
--EXPECTF--
Fatal error: Class Demo contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (HasCustomCast::__doCast) in %s on line %d