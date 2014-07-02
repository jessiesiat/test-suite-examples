<?php 

namespace Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;

class HttpClient {

	/**
	 * @var Symfony\Component\Routing\RouteCollection
	 */
	private $routeCollection;

	/**
	 * @var Symfony\Component\Routing\RequestContext
	 */
	private $requestContext;
	
	/**
	 * Initialize variables
	 */
	public function __construct()
	{
		$this->routeCollection = $this->routeCollection ?: new RouteCollection();
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
	public function addRoute($routeName, $path, $params)
	{
		$route = new Route($routeName, $params);

		$this->routeCollection->add($routeName, $route);

		return $this->routeCollection;
	}

	/**
	 * Match a path to a route
	 *
	 * @param  string $path 
	 * @return mixed  
	 */
	public function match($path)
	{
		$urlMatcher = new UrlMatcher($this->routeCollection, $this->requestContext);

		return $urlMatcher->match($path);
	}

}