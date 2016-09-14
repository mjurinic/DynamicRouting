<?php


namespace ElementsFramework\DynamicRouting\Handler;


use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class RedirectRouteHandler extends AbstractRouteTypeHandler
{

    /**
     * Uses the user input and the route definition to build and return a response for the user.
     * @param Request $request
     * @param DynamicRoute $route
     * @return Response
     */
    public function process(Request $request, DynamicRoute $route)
    {
        if(isset($route->configuration['status_code']) && in_array((int)$route->configuration['status_code'], [300,301,302,303,304,305,307,308])) {
            return Redirect::to($route->configuration['target'], (int)$route->configuration['status_code']);
        }
        return Redirect::to($route->configuration['target']);
    }

    /**
     * Checks if the given route object is a valid route that can be handled with this handler.
     * @param DynamicRoute $route
     * @return boolean
     */
    public static function isValid(DynamicRoute $route)
    {
        if(isset($route->configuration['target']) === false) {
            return false;
        }

        return true;
    }
}