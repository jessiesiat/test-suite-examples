<?php 

class FixturesTest extends PHPUnit_Framework_TestCase {

	protected $stack;
	
	/**
	 * Is called once before each test methods
	 */
	public function setUp()
	{
		$this->stack = array();
	}

	public function testEmpty()
	{
		$this->assertEmpty($this->stack);
	}

	public function testPush()
	{
		array_push($this->stack, 'test');
		$this->assertEquals('test', $this->stack[count($this->stack)-1]);
		$this->assertNotEmpty($this->stack);
	}

	public function testPop()
	{
		array_push($this->stack, 'test');
		$this->assertEquals('test', array_pop($this->stack));
		$this->assertEmpty($this->stack);
	}

}