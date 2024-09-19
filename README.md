# CustomCast

This is a PHP extension (built/tested against PHP 8.3) that allows classes
to decide how they want to be treated when cast to a boolean, int, or double,
instead of using the default behavior.

## Usage on a class
A class can define a new magic method,
`__doCast(CustomCasting\CastableTarget $t)`, that will get called when the
object is cast to a boolean, int, or double. The `CastableTarget` parameter
will indicate the type the object is being cast to - it is an enum, defined
as:

```
enum CastableTarget {
	case CAST_BOOL;
	case CAST_FLOAT;
	case CAST_LONG;
}
```

the `__doCast()` method should then return the value that the class wants to
be treated as.

## Enabling for a class
Once the extension is installed, the INI option `custom_cast.use_observer`
determines if a class needs to manually enable the magic method, or if it will
be used automatically (if present). The option defaults to `false`, on the
assumption that it could negatively impact performance to check each class
for the magic method. Instead, classes should be annotated with the
`CustomCasting\CustomCastable` attribute to trigger the extension's behavior.

The attribute can be used without any parameters, but a parameter can also
be provided to limit the types of casts for which the `__doCast()` method will
be used, by providing a bitflag combination of
* `CustomCastable::TARGET_BOOL` (use `__doCast()` for boolean casts)
* `CustomCastable::TARGET_FLOAT` (use `__doCast()` for float casts)
* `CustomCastable::TARGET_LONG` (use `__doCast()` for integer casts)

If the `custom_cast.use_observer` INI option is enabled, the attribute is not
required, but can still be used to limit the types of casts supported.