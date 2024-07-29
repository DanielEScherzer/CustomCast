--TEST--
Details from ReflectionExtension
--EXTENSIONS--
custom_cast
--FILE--
<?php

$e = new ReflectionExtension('custom_cast');
$toShow = [
	'Name',
	'Version',
	'ClassNames',
	'Dependencies',
	'Functions',
	'INIEntries',
];
foreach ( $toShow as $meth ) {
	echo $meth . ":\n";
	var_dump( $e->{'get' . $meth}() );
	echo "\n";
}

echo "All info:\n";
$e->info();

?>
--EXPECT--
Name:
string(11) "custom_cast"

Version:
string(5) "0.1.0"

ClassNames:
array(3) {
  [0]=>
  string(28) "CustomCasting\CustomCastable"
  [1]=>
  string(28) "CustomCasting\CastableTarget"
  [2]=>
  string(27) "CustomCasting\HasCustomCast"
}

Dependencies:
array(0) {
}

Functions:
array(0) {
}

INIEntries:
array(1) {
  ["custom_cast.use_observer"]=>
  string(1) "0"
}

All info:

custom_cast

custom_cast support => enabled

Directive => Local Value => Master Value
custom_cast.use_observer => Off => Off