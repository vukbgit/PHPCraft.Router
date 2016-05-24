<?php

namespace PHPCraft\Router;

use FastRoute\RouteCollector;

/**
 * Manages cookies using Http class by Patrick Louys (https://github.com/PatrickLouys/http)
 *
 * @author vuk <info@vuk.bg.it>
 */
class CookieDflydevFigCookiesAdapter implements CookieInterface
{
    private $routeCollector;

/**
     * Constructor.
     *
     * @param FastRoute\RouteCollector $routeCollector
     **/
    public function __construct(RouteCollector $routeCollector)
    {
        $this->routeCollector = $routeCollector;
    }
    
    /**
     * adds a route
     *
     * @param mixed $method a string (or an array of strings) with the HTTP methods assocaited to the route
     * @param string $route
     * @param array $properties an array with any custom property to be associated to the route
     **/
    public function addRoute($method, $route, $properties = array())
    {
            $this->routeCollector;
    }
    
    /**
     * Gets cookie
     *
     * @param string $path to be parsed and matched against registered routes
     * @return array with following elements:
     *              properties: as defined into the addRoute call $properties argument
     *              parameters: an array with any parameter eventually extracted from the url
     **/
    public function dispatch($path)
    {
    }
}