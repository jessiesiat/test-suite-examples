<?php

/**  
 * The practice of replacing an object with a test double that verifies
 * expectations, for instance asserting that a method has been called, 
 * is refered to as mocking.  
 */

class MockTest extends PHPUnit_Framework_TestCase {
	
	public function testMockObserver()
	{
		// get mock object of Observer and we only need the update method.
		// Although class Observer is available under SUT, on actual
		// scenario we will use the real object.
		$observer = $this->getMock('Observer', array('update'));

		//initialize subject
		$subject = new Subject('Mock testing');

		$observer->expects($this->once())
				 ->method('update')
				 ->with($this->equalTo($subject));

		$subject->attach($observer);

		$subject->notify();
	}

	public function testIdenticalObjectPassed()
    {
        $expectedObject = new stdClass;

        // get mock of php's stdClass
        $mock = $this->getMock('stdClass', array('foo'));

        $mock->expects($this->once())
             ->method('foo')
             ->with($this->identicalTo($expectedObject));

        $mock->foo($expectedObject);
    }

}