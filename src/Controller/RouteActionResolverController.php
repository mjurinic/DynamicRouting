<?php


namespace ElementsFramework\DynamicRouting\Controller;

use ElementsFramework\DynamicRouting\Exception\HandlerNotFoundException;
use ElementsFramework\DynamicRouting\Handler\AbstractRouteTypeHandler;
use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use ReflectionClass;

class RouteActionResolverController extends BaseController
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
        foreach(config('dynamic-routing.handlers') as $handlerClass) {
            $handlerMetadata = new ReflectionClass($handlerClass);
            if($route->handler == $handlerMetadata->getShortName()) {
                /** @var AbstractRouteTypeHandler $handler */
                $handler = new $handlerClass();
                return $handler->process($request, $route);
            }
        }
        throw HandlerNotFoundException::fromIdentifier($route->handler);
    }
}