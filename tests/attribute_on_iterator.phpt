--TEST--
Check that the `CustomCastable` attribute on an Iterator doesn't break the handling of that
--EXTENSIONS--
custom_cast
--FILE--
<?php
#[CustomCastable]
class Demo implements Iterator {
	private $data = [ 'a', 'b', 'c' ];
	private $idx = 0;

	public function current(): mixed { return $this->data[$this->idx]; }
	public function key(): mixed { return $this->idx; }
	public function next(): void { $this->idx++; }
	public function rewind(): void { $this->idx = 0; }
	public function valid(): bool {
		return $this->idx >= 0 && $this->idx < count( $this->data );
	}
	public function __doCast(CastableTarget $t) {
	}

}

$d = new Demo();
foreach ( $d as $v ) {
	var_dump( $v );
}
?>
--EXPECT--
string(1) "a"
string(1) "b"
string(1) "c"