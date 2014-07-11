<?php

namespace Test\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface {

	public static $subscribers = array(
		'login' => 'loginHandler',
		'logout' => 'logoutHandler'
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
	public function loginHandler()
	{
		echo 'user login';
	}

	/**
	 * Logout event handler
	 * 
	 * @return string
	 */
	public function logoutHandler()
	{
		echo 'user logout';
	}

}