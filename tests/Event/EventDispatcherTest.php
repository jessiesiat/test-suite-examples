<?php

use Test\Event\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;

class EventDispatcherTest extends PHPUnit_Framework_TestCase {

	public $dispatcher;

	public $event;

	/**
	 * Initialize event dispatcher instance.
	 * This is called before every test methods.
	 */
	public function setUp()
	{
		$this->event = new Event();
		$this->dispatcher = new EventDispatcher();
	}
	
	public function testCanAddEventListenerAndDispatch()
	{
		$this->dispatcher->addListener('sign-up', function(Event $event) {
			echo 'User sign-up';
		});

		$this->assertTrue($this->dispatcher->hasListeners('sign-up'));
		$this->assertCount(1, $this->dispatcher->getListeners('sign-up'));

		$this->assertInstanceOf('Symfony\Component\EventDispatcher\Event', $this->dispatcher->dispatch('sign-up'));
		$return = $this->dispatcher->dispatch('sign-up', $this->event);
		$this->assertEquals('sign-up', $return->getName());
	}

}