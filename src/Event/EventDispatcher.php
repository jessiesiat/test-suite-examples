<?php

namespace Test\Event;

use Symfony\Component\EventDispatcher\EventDispatcher as BaseEventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

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
	 * Dispatches all listeners to an event.
	 *
	 * @param string $eventName
	 * @return void
	 */
	public function dispatch($eventName)
	{
		return $this->dispatcher->dispatch($eventName);
	}

	/**
	 * Add listener to a specific event
	 *
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
	 * Retuns the listeners of a specific event 
	 *
	 * @param string $eventName
	 * @return array
	 */
	public function getListeners($eventName = null)
	{
		return $this->dispatcher->getListeners($eventName);
	}

	/**
	 * Checks whether an event has listeners 
	 *
	 * @param string $eventName
	 * @return boolean
	 */
	public function hasListeners($eventName = null)
	{
		return $this->dispatcher->hasListeners($eventName);
	}

	/** 
	 * Add event subscriber
	 *
	 * @param Symfony\Component\EventDispatcher\EventSubscriberInterface $subscriber
	 * @return void
	 */
	public function addSubscriber(EventSubscriberInterface $subscriber)
	{
		$this->dispatcher->addSubscriber($subscriber);
	}

	/**
	 * Remove event subscriber
	 *
	 * @param Symfony\Component\EventDispatcher\EventSubscriberInterface $subscriber
	 * @param void
	 */
	public function removeSubscriber(EventSubscriberInterface $subscriber)
	{
		$this->dispatcher->removeSubscriber($subscriber);
	}

}