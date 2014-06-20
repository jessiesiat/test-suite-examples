<?php

class DataProviderTest extends PHPUnit_Framework_TestCase {
	
	public function stringProvider()
	{
		return array(
			array('foo'),
			array('bar'),
			array('baz')
			);
	}

	/**
	 * Argument of this test is provided by @stringProvider method.
	 * For each array that is part of the collection, this test
	 * method will be called with the contents of the array as
	 * its arguments
	 * 
	 * @dataProvider stringProvider
	 */
	public function testDataProvider($string)
	{
		$expected_array = array('foo', 'bar', 'baz');

		$this->assertTrue(in_array($string, $expected_array));
	}

}