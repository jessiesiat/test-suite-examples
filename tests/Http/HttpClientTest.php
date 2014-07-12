<?php

use Test\Http\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

	public function testCanMatchAPath()
	{
		$this->httpClient->addRoute('hello', '/hello', array('controller' => 'foo'));
		$param = $this->httpClient->matchPath('/hello');

		$this->assertEquals('foo', $param['controller']);
	}

	public function testClientCanReturnResponse()
	{
		$this->httpClient->addRoute('home', '/', array('_controller' => 
			function(Request $request) {
				return new Response("You have arrived", 500, array('Content-Type' => 'text/plain'));
			}
		));

		// assertions
		$response = $this->httpClient->run();
		$this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals('You have arrived', $response->getContent());
		$this->assertEquals(500, $response->getStatusCode());
		$this->assertTrue($response->headers->contains('Content-Type', 'text/plain'));
	}

}