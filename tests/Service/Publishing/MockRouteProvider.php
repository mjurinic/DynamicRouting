<?php


namespace Tests\Service\Publishing;


use ElementsFramework\DynamicRouting\Interfaces\RouteProvider;
use ElementsFramework\DynamicRouting\Model\DynamicRoute;

class MockRouteProvider implements RouteProvider
{

    /**
     * Returns an array of unpersisted DynamicRoute objects which will
     * be created if they already don't exist.
     * @return DynamicRoute[]
     */
    public static function getDefaultDynamicRoutes()
    {
        return [
            new DynamicRoute([
                'method' => 'get',
                'name' => 'test',
                'pattern' => '/test',
                'handler' => 'RedirectRouteHandler',
                'configuration' => ['target' => '/'],
            ]),
        ];
    }
}