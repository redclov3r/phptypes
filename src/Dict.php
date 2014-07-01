<?php
namespace bettertypes;

use Exception;
use ArrayAccess;
use Countable;

class Dict implements ArrayAccess, Countable {
	private $container;
    public function __construct($container = array()) {
		$this->container = $container;
    }

	public function get($offset, $default = null) {
		if ($this->offsetExists($offset)) {
			return $this->offsetGet($offset);
		}
		return $default;
	}
	/* Countable */
    public function count() {
        return count($this->container);
    }

	/* ArrayAccess */
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
			throw new Exception("You must provide an offset");
        } else {
            $this->container[$offset] = $value;
        }
    }
    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }
    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}
