--TEST--
Check if custom_cast is loaded
--EXTENSIONS--
custom_cast
--FILE--
<?php
echo 'The extension "custom_cast" is available';
?>
--EXPECT--
The extension "custom_cast" is available
