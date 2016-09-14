<?php


namespace ElementsFramework\DynamicRouting\Controller;

use ElementsFramework\DynamicRouting\Exception\HandlerNotFoundException;
use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use ElementsFramework\DynamicRouting\Service\RouteHandlerResolver;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RouteDispatcher
{
    /**
     * RouteActionResolverController constructor.
     */
    public function __construct()
    {
        $this->middleware(config('dynamic-routing.middleware-group'));
    }

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
        return RouteHandlerResolver::getInstance($route->handler)->process($request);
    }
}