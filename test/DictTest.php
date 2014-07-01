<?php

use bettertypes\Dict;

class DictTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
    }

    public function testDictCanBeCreatedEmpty() {
        $dict = new Dict();
        return $dict;
    }

    public function testDictCanBeCreatedFromArray() {
        $dict = new Dict(array("foo" => "bar", "baz" => "bar"));
        $this->assertEquals(2, count($dict));
        $this->assertEquals("bar", $dict["foo"]);
        $this->assertEquals("bar", $dict["baz"]);
        return $dict;
    }

    /**
     * @depends testDictCanBeCreatedEmpty
     */
    public function testDictIsEmptyWhenCreated($dict) {
        $this->assertEquals(0, count($dict));
        return $dict;
    }

    /**
     * @depends testDictIsEmptyWhenCreated
     */
    public function testDictKeysCanBeSet($dict) {
        $dict["foo"] = "bar";
        $this->assertEquals(1, count($dict));

        $dict["baz"] = "bar";
        $this->assertEquals(2, count($dict));

        return $dict;
    }

    /**
     * @depends testDictKeysCanBeSet
     */
    public function testDictValuesCanBeRetrieved($dict) {
        $this->assertEquals("bar", $dict["foo"]);
        $this->assertEquals("bar", $dict->get("foo"));
        $this->assertEquals("bar", $dict->get("foo", "default"));

        $this->assertEquals("bar", $dict["baz"]);
        $this->assertEquals("bar", $dict->get("baz"));
        $this->assertEquals("bar", $dict->get("baz", "default"));

        return $dict;
    }

    /**
     * @depends testDictValuesCanBeRetrieved
     */
    public function testDictKeysCanBeUnset($dict) {
        $previousCount = count($dict);
        unset($dict["foo"]);
        $this->assertEquals($previousCount - 1, count($dict));
        $this->assertEquals(null, $dict["foo"]);
        $this->assertEquals(null, $dict->get("foo"));
        $this->assertEquals("default", $dict->get("foo", "default"));

        return $dict;
    }

    /**
     * @depends testDictCanBeCreatedEmpty
     */
    public function testGetWithDefaults($dict) {
        $dict["foo"] = "bar";
        $this->assertEquals("bar", $dict->get("foo", "default"));

        $this->assertEquals("default", $dict->get("unset", "default"));
        $this->assertEquals(null, $dict->get("unset"));
    }

    /**
     * @depends testDictCanBeCreatedEmpty
     * @expectedException Exception
     */
    public function testThrowsExceptionWithoutOffset($dict) {
        $dict[] = "bar";
    }
}
