--TEST--
The `custom_cast.use_observer` INI setting can be true
--EXTENSIONS--
custom_cast
--INI--
custom_cast.use_observer=true
--FILE--
<?php
var_dump(ini_get('custom_cast.use_observer'));
?>
--EXPECT--
string(1) "1"