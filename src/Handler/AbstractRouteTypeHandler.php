<?php


namespace ElementsFramework\DynamicRouting\Handler;

use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class AbstractRouteTypeHandler
{
    /**
     * Uses the user input and the route definition to build and return a response for the user.
     * @param Request $request
     * @param DynamicRoute $route
     * @return Response
     */
    abstract public function process(Request $request, DynamicRoute $route);
}