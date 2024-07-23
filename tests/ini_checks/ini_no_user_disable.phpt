--TEST--
PHP code cannot disable `custom_cast.use_observer` INI setting
--EXTENSIONS--
custom_cast
--INI--
custom_cast.use_observer=true
--FILE--
<?php
var_dump(ini_get('custom_cast.use_observer'));
var_dump(ini_set('custom_cast.use_observer', '0'));
var_dump(ini_get('custom_cast.use_observer'));
?>
--EXPECT--
string(1) "1"
bool(false)
string(1) "1"