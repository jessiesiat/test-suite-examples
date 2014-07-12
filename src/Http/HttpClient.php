<?php 

namespace Test\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class HttpClient {

	/**
	 * @var Symfony\Component\Routing\RouteCollection
	 */
	private $routesCollection;

	/**
	 * @var Symfony\Component\Routing\RequestContext
	 */
	private $requestContext;
	
	/**
	 * Initialize variables
	 */
	public function __construct()
	{
		$this->routesCollection = $this->routesCollection ?: new RouteCollection();
		$this->requestContext = $this->requestContext ?: new RequestContext();
	}

	/**
	 * Add a new route to the collection
	 *
	 * @param  string $routename
	 * @param  string $path 
	 * @param  string $params 
	 * @return Symfony\Component\Routing\RouteCollection
	 */
	public function addRoute($routeName, $path, array $params)
	{
		$route = new Route($path, $params);

		$this->routesCollection->add($routeName, $route);

		return true;
	}

	/**
	 * Run the application matching a request and returns a response
	 * @return Symfony\Component\HttpFoundation\Response
	 */
	public function run()
	{
		$request = Request::createFromGlobals();

		// create request context
		$this->createRequestContext($request);

		// setup url matcher and event dispatcher
		$dispatcher = $this->setUpDispatcher($this->setUpUrlMatcher());

		// setup controller resolver
		$resolver = new ControllerResolver();

		// setup core http kernel
		$kernel = new HttpKernel($dispatcher, $resolver);

		// handle the request and send response
    	return $kernel->handle($request)->send();
	}

	/**
	 * Creates request context
	 *
	 * @return void
	 */
	public function createRequestContext($request)
	{
		$this->requestContext->fromRequest($request);
	}

	/**
	 * Url Matcher setup
	 *
	 * @return Symfony\Component\Routing\Matcher\UrlMatcher  
	 */
	public function setUpUrlMatcher()
	{
		$urlMatcher = new UrlMatcher($this->routesCollection, $this->requestContext);

		return $urlMatcher;
	}

	/**
	 * Match a path to a route
	 *
	 * @param  string $path 
	 * @return mixed  
	 */
	public function matchPath($path)
	{
		$urlMatcher = new UrlMatcher($this->routesCollection, $this->requestContext);

		return $urlMatcher->match($path);
	}

	/** 
	 * Setup Event Dispatcher
	 *
	 * @return Symfony\Component\EventDispatcher\EventDispatcher
	 */
	public function setUpDispatcher(UrlMatcher $urlMatcher)
	{
		$dispatcher = new EventDispatcher();
    
    	$dispatcher->addSubscriber(new RouterListener($urlMatcher));

    	return $dispatcher;
	}

}