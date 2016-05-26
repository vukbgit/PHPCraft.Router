<?php

namespace PHPCraft\Router;

/**
 * Manages routing
 *
 * @author vuk <info@vuk.bg.it>
 */
interface RouterInterface
{
    /**
     * Adds a route
     *
     * @param mixed $method a string (or an array of strings) with the HTTP methods assocaited to the route
     * @param string $route
     * @param array $properties an array with any custom property to be associated to the route
     **/
    public function addRoute($method, $route, $properties = array());
    
    /**
     * Parses current request and matches it against defined routes
     *
     * @return array with following elements:
     *              properties: as defined into the addRoute call $properties argument
     *              parameters: an array with any parameter eventually extracted from the url
     **/
    public function dispatch();
    
    /**
     * Gets error for last dispatch try
     * @return integer error code:
     *                      404 = NOT FOUND
     *                      405 = METHOD NOT ALLOWED
     *                      406 = NOT ACCEPTABLE
     **/
    public function getError();
}