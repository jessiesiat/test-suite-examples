<?php

class SubjectTest extends PHPUnit_Framework_TestCase {

	// Observer class
	protected $observer;

	// Subject class
	protected $subject;

	// called before every test methods
	public function setUp()
	{
		$this->observer = new Observer;
		$this->subject = new Subject('My Subject');
	}
	
	public function testCanAttachObserver()
	{
		$this->subject->attach($this->observer);

		$this->assertEquals($this->subject->observers[0], $this->observer);
	}

	public function testCanNotifyObserver()
	{
		$this->subject->attach($this->observer);

		$this->assertContains('notified', $this->subject->notify());
	}

	public function testSubjectNameGetter()
	{
		$this->assertEquals('My Subject', $this->subject->name());
	}

	public function testCanSetValueThroughSetters()
	{
		$this->subject->foo = 'bar';

		$this->assertEquals('bar', $this->subject->foo);
		$this->assertNotEquals('baz', $this->subject->foo);
	}

	/**
	 * @expectedException 			Exception
	 * @expectedExceptionMessage 	Undefined property via __get()
	 */
	public function testWillThrowGetterException()
	{
		$foo = $this->subject->foo;
	}

}