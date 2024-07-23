--TEST--
Does the `custom_cast.use_observer` INI setting exist?
--EXTENSIONS--
custom_cast
--FILE--
<?php
var_dump(ini_get('custom_cast.use_observer'));
?>
--EXPECT--
string(1) "0"
