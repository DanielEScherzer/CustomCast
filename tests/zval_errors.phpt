--TEST--
Check that the `CustomCastable` attribute isn't causing issues with zvals
--DESCRIPTION--
Was getting errors of "Internal zval's can't be arrays, objects, resources or
reference" in various cases, make sure to detect if that happens again
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
class UnusedParam {
    public function __doCast(CastableTarget $t) {
	}

}

#[CustomCastable]
class WithSwitch {
	public function __doCast(CastableTarget $t) {
		switch ($t) {
			case CastableTarget::CAST_BOOL:
				return false;
			case CastableTarget::CAST_FLOAT:
				return 23.45;
			case CastableTarget::CAST_LONG:
				return 987;
		}
	}
}

#[CustomCastable]
class WithMatch {
	public function __doCast(CastableTarget $t) {
		return match ( $t ) {
			CastableTarget::CAST_BOOL => false,
			CastableTarget::CAST_FLOAT => 23.45,
			CastableTarget::CAST_LONG => 987,
		};
	}
}

function demo( $clazz ) {
	echo $clazz . ":\n";
	$instance = new $clazz();
	var_dump( (bool)$instance );
	var_dump( (float)$instance );
	var_dump( (int)$instance );
}

demo( UnusedParam::class );
demo( WithSwitch::class );
demo( WithMatch::class );

?>
--EXPECTF--
UnusedParam:
bool(true)

Warning: Object of class UnusedParam could not be converted to float in %s on line %d
float(1)

Warning: Object of class UnusedParam could not be converted to int in %s on line %d
int(1)
WithSwitch:
bool(false)
float(23.45)
int(987)
WithMatch:
bool(false)
float(23.45)
int(987)
