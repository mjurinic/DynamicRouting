<?php


namespace ElementsFramework\DynamicRouting\Handler;

use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

interface AbstractRouteTypeHandler
{
    /**
     * Uses the user input and the route definition to build and return a response for the user.
     * @param Request $request
     * @param DynamicRoute $route
     * @return Response
     */
    public function process(Request $request, DynamicRoute $route);

    /**
     * Checks if the given route object is a valid route that can be handled with this handler.
     * @param DynamicRoute $route
     * @return boolean
     */
    public static function isValid(DynamicRoute $route);
}