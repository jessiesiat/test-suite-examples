<?php

namespace Test\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface {

	public static $subscribers = array(
		'login' => 'loginEventHandler',
		'logout' => 'logoutEventHandler'
		);

	/**
	 * Returns the events and its listeners
	 *
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return static::$subscribers;
	}

	/**
	 * Login event handler
	 *
	 * @return string
	 */
	public function loginEventHandler()
	{
		echo 'user login';
	}

	/**
	 * Logout event handler
	 * 
	 * @return string
	 */
	public function logoutEventHandler()
	{
		echo 'user logout';
	}

}