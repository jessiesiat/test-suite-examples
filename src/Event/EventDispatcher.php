<?php

namespace Test\Event;

use Symfony\Component\EventDispatcher\EventDispatcher as BaseEventDispatcher;
use Symfony\Component\EventDispatcher\Event;

class EventDispatcher {

	/**
	 * @var Symfony\Component\EventDispatcher\EventDispatcher
	 */
	protected $dispatcher;

	/**
	 * Instantiate dispatcher instance 
	 */
	public function __construct()
	{
		$this->dispatcher = $this->dispatcher ?: new BaseEventDispatcher();
	}
	
	/**
	 * @param string $eventName
	 * @param callable $value
	 * @return void
	 */
	public function addListener($eventName, $value)
	{
		// if $value is not a closure then will force it to be one!
		if (!$value instanceof Closure)
		{
			$value = function(Event $event) use ($value) 
			{
				return $value;
			};
		}

		$this->dispatcher->addListener($eventName, $value);
	}

	/**
	 * @param string $eventName
	 * @return void
	 */
	public function dispatch($eventName)
	{
		return $this->dispatcher->dispatch($eventName);
	}

	/**
	 * @param string $eventName
	 * @return array
	 */
	public function getListeners($eventName)
	{
		return $this->dispatcher->getListeners($eventName);
	}

	/**
	 * @param string $eventName
	 * @return boolean
	 */
	public function hasListeners($eventName)
	{
		return $this->dispatcher->hasListeners($eventName);
	}

}