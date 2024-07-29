--TEST--
Check if custom_cast is loaded
--EXTENSIONS--
custom_cast
--FILE--
<?php
// Assume loaded since the --EXTENSIONS-- check above passed
echo "The extension \"custom_cast\" is available\n";
// But also can check with extension_loaded()
var_export(extension_loaded('custom_cast'));
?>
--EXPECT--
The extension "custom_cast" is available
true
