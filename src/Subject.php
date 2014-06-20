<?php

class Subject {
	
	// name of the subject
	protected $name;

	// observers for the subject
	public $observers = array();

	// data array set via __set magic method
	private $data = array();

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function name()
	{
		return $this->name;
	}

	public function attach(Observer $observer)
	{
		$this->observers[] = $observer;
	}

	public function notify()
	{
		foreach ($this->observers as $observer) {
			$observer->update($this);
		}

		return 'Done notified';
	}

	public function __set($name, $value)
	{
		$this->data[$name] = $value;

		$this->notify();
	}

	public function __get($name)
	{
		if(array_key_exists($name, $this->data)) 
		{
			return $this->data[$name];
		}

		throw new Exception('Undefined property via __get()');
	}

}