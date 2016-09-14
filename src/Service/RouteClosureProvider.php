<?php


namespace ElementsFramework\DynamicRouting\Service;


use ElementsFramework\DynamicRouting\Controller\RouteDispatcher;
use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use Illuminate\Http\Request;

class RouteClosureProvider
{

    /**
     * @param DynamicRoute $route
     * @return \Closure
     */
    public static function forRoute(DynamicRoute $route)
    {
        return function(Request $request) use ($route) {
            $dispatcher = new RouteDispatcher();
            return $dispatcher->dispatchRouteToHandler($request, $route);
        };
    }

}