<?php

class ArrayTest extends PHPUnit_Framework_TestCase {

	public function testArrayPushAndPop()
	{
		$stack = array();
        $this->assertEmpty($stack);

		array_push($stack, 'foo');
		$this->assertEquals('foo', $stack[count($stack)-1]);
		$this->assertNotEmpty($stack);

		$this->assertEquals('foo', array_pop($stack));
		$this->assertEmpty($stack);
	}

}