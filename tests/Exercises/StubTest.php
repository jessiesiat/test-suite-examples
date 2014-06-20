<?php

/**
 * Sometimes it is hard to test a system under test (SUT) if it depends on a 
 * component that is not available in a test environment. We are then 
 * force to not use a real depended-on component (DOC) and replace it 
 * with a test double. Test double doesn't have to behave exactly   
 * like a real DOC, it merely has to provide the same API as the  
 * real one so that the SUT thinks it is the real one!
 *
 * Stubbing is a practice of replacing real objects with test double that 
 * (optionaly) returns configured values. 
 */

class StubTest extends PHPUnit_Framework_TestCase {
	
	public function testStub()
	{
		// create a stub for the Money class
		$stub = $this->getMockBuilder('Money')
					 ->disableOriginalConstructor()
					 ->getMock();

		// configure the stub
		$stub->expects($this->any())
			 ->method('getAmount')
			 ->will($this->returnValue(100));

		// call stub method and assert
		$this->assertEquals(100, $stub->getAmount());
	}

	public function testArgumentStub()
	{
		// create a stub for the Money class
		$stub = $this->getMockBuilder('Money')
					 ->disableOriginalConstructor()
					 ->getMock();

		// configure the stub
		$stub->expects($this->any())
			 ->method('getAmount')
			 ->will($this->returnArgument(0));

		// call stub method and assert
		$this->assertEquals(100, $stub->getAmount(100));
	}

	public function testSelfStub()
	{
		// create a stub for the Money class
		$stub = $this->getMockBuilder('Money')
					 ->disableOriginalConstructor()
					 ->getMock();

		// configure the stub
		$stub->expects($this->any())
			 ->method('getAmountDouble')
			 ->will($this->returnSelf());

		// call stub method and assert
		$this->assertEquals($stub, $stub->getAmountDouble());
	}

	/**
     * @expectedException	Exception
     */
	public function testThrowExceptionStub()
	{
		// create a stub for the Money class
		$stub = $this->getMockBuilder('Money')
					 ->disableOriginalConstructor()
					 ->getMock();

		// configure the stub
		$stub->expects($this->any())
			 ->method('getAmount')
			 ->will($this->throwException(new Exception));

		// call stub method
		$stub->getAmount();
	}

}