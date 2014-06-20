<?php

class ObserverTest extends PHPUnit_Framework_TestCase {
	
	public function testObserverUpdateOutput()
	{
		$observer = new Observer;
		$subject = new Subject('My subject');

		$this->assertContains(get_class($subject), $observer->update($subject));
	}

}