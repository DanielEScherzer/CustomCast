--TEST--
The `custom_cast.use_observer` INI setting exists
--EXTENSIONS--
custom_cast
--FILE--
<?php
var_dump(ini_get('custom_cast.use_observer'));
?>
--EXPECT--
string(1) "0"
