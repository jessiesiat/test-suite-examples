<?php

class DependsTest extends PHPUnit_Framework_TestCase {
	
	public function testEmpty()
	{
		$stack = array();
        $this->assertEmpty($stack);

        return $stack;
	}
	
	/**
	 * Argument of this test depends on what's returned from @testEmpty method
	 * 
	 * @depends testEmpty
	 */
	public function testPush(array $stack)
	{
		array_push($stack, 'foo');
		$this->assertEquals('foo', $stack[count($stack)-1]);
		$this->assertNotEmpty($stack);

		return $stack;
	}
	
	/**
	 * Argument of this test depends on what's returned from @testPush method
	 * 
	 * @depends testPush
	 */
	public function testPop(array $stack)
	{
		$this->assertEquals('foo', array_pop($stack));
		$this->assertEmpty($stack);
	}

}