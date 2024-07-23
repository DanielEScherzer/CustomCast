--TEST--
PHP code cannot enable `custom_cast.use_observer` INI setting
--EXTENSIONS--
custom_cast
--FILE--
<?php
var_dump(ini_get('custom_cast.use_observer'));
var_dump(ini_set('custom_cast.use_observer', '1'));
var_dump(ini_get('custom_cast.use_observer'));
?>
--EXPECT--
string(1) "0"
bool(false)
string(1) "0"
