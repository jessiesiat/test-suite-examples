<?php

use Test\Http\HttpClient;

class HttpClientTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var Http\HttpClient
	 */
	protected $httpClient;
	
	// Called before every test methods
	public function setUp()
	{
		$this->httpClient = new HttpClient;
	}

	public function testCanAddRoute()
	{
		$route = $this->httpClient->addRoute('hello', '/hello', array('controller' => 'foo'));
		$this->assertTrue($route);
	}

	public function testCanMatchARoute()
	{
		$this->httpClient->addRoute('hello', '/hello', array('controller' => 'foo'));
		$param = $this->httpClient->match('/hello');

		$this->assertEquals('foo', $param['controller']);
	}

}