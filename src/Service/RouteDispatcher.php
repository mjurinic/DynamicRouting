<?php


namespace ElementsFramework\DynamicRouting\Service;

use ElementsFramework\DynamicRouting\Exception\HandlerNotFoundException;
use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use ElementsFramework\DynamicRouting\Service\RouteHandlerResolver;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RouteDispatcher
{
    /**
     * Finds the needed handler from the registered handlers list and processes the
     * requests within the handler.
     * @param Request $request
     * @param DynamicRoute $route
     * @return Response
     * @throws HandlerNotFoundException
     */
    public function dispatchRouteToHandler(Request $request, DynamicRoute $route)
    {
        return RouteHandlerResolver::getInstance($route->handler)->process($request, $route);
    }
}