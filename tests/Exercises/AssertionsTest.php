<?php

class AssertionsTest extends PHPUnit_Framework_TestCase {

	public function testOutputAssertion()
	{
		$this->expectOutputString('foo');
		print 'foo';
	}

	public function testRegex()
	{
		$string = 'this output **matches** the regular expression provided';
		// matches **bold** , **sick** 
		$this->assertRegExp('/\*\*(.*)\*\*/', $string);
	}

}