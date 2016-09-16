<?php

namespace ElementsFramework\DynamicRouting\Exception;

use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use Exception;

class BasicValidationFailedForRouteException extends Exception
{

    public static function fromRoute(DynamicRoute $route)
    {
        return new self("Could not save the route with following info '{$route->method} {$route->pattern} {$route->name}' because the basic validation failed.");
    }

}