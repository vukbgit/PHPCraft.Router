<?php

namespace PHPCraft\Router;

use FastRoute;

/**
 * Manages cookies using Http class by Patrick Louys (https://github.com/PatrickLouys/http)
 *
 * @author vuk <info@vuk.bg.it>
 */
class RouterNikicFastRoute implements RouterInterface
{
    private $routeCollector;
    private $messageCode;

    /**
     * Constructor.
     **/
    public function __construct()
    {
        $routeParser = new FastRoute\RouteParser\Std;
        $dataGenerator = new FastRoute\DataGenerator\GroupCountBased;
        $this->routeCollector = new FastRoute\RouteCollector($routeParser, $dataGenerator);
    }
    
    /**
     * Adds a route
     *
     * @param mixed $method a string (or an array of strings) with the HTTP methods assocaited to the route
     * @param string $route
     * @param array $properties an array with any custom property to be associated to the route
     **/
    public function addRoute($method, $route, $properties = array())
    {
        $this->routeCollector->addRoute($method, $route, $properties);
    }
    
    /**
     * Parses current request and matches it against defined routes
     *
     * @return mixed false on failure or array with following elements:
     *              properties: as defined into the addRoute call $properties argument
     *              parameters: an array with any parameter eventually extracted from the url
     **/
    public function dispatch()
    {
        $dispatcher = new FastRoute\Dispatcher\GroupCountBased($this->routeCollector->getData());
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        //success
        if($routeInfo[0] == FastRoute\Dispatcher::FOUND) {
            return [
                'properties' => $routeInfo[1],
                'parameters' => $routeInfo[2]
            ];
        } else {
        //failure
            $this->messageCode = $routeInfo[0];
            return false;
        }
    }
    
    /**
     * Gets error for last dispatch try
     * @return integer error code:
     *                      404 = NOT FOUND
     *                      405 = METHOD NOT ALLOWED
     *                      406 = NOT ACCEPTABLE
     **/
    public function getError()
    {
        switch($this->messageCode) {
            case FastRoute\Dispatcher::NOT_FOUND:
                return 404;
            break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                return 405;
            break;
        }
    }
}