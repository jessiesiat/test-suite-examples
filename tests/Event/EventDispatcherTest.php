<?php

use Test\Event\EventDispatcher;
use Test\Event\UserSubscriber;
use Symfony\Component\EventDispatcher\Event;

class EventDispatcherTest extends PHPUnit_Framework_TestCase {

	public $dispatcher;

	/**
	 * Initialize event dispatcher instance.
	 * This is called before every test methods.
	 */
	public function setUp()
	{
		$this->dispatcher = new EventDispatcher();
	}

	public function testCanAddEventListener()
	{
		$this->dispatcher->addListener('email', function() {
			echo 'user email';
		});
		$this->dispatcher->addListener('invoice', function() {
			echo 'user invoice';
		});

		// assertions
		$this->assertTrue($this->dispatcher->hasListeners('email'));
		$this->assertCount(2, $this->dispatcher->getListeners());
	}
	
	public function testCanAddEventListenerAndDispatch()
	{
		$this->dispatcher->addListener('sign-up', function(Event $event) {
			echo 'User sign-up';
		});

		// assertions
		$this->assertTrue($this->dispatcher->hasListeners('sign-up'));
		$this->assertCount(1, $this->dispatcher->getListeners('sign-up'));

		$this->assertInstanceOf('Symfony\Component\EventDispatcher\Event', $this->dispatcher->dispatch('sign-up'));
		$return = $this->dispatcher->dispatch('sign-up');
		$this->assertEquals('sign-up', $return->getName());
	}

	public function testCanAddSubscriber()
	{
		$this->dispatcher->addSubscriber(new UserSubscriber());

		// assertions
		$this->assertTrue($this->dispatcher->hasListeners('login'));
		$this->assertCount(2, $this->dispatcher->getListeners());
	}

}