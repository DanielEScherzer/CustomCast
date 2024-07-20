--TEST--
`HasCustomCast` interface exists
--EXTENSIONS--
custom_cast
--FILE--
<?php
var_dump(interface_exists('HasCustomCast'));
?>
--EXPECT--
bool(true)
