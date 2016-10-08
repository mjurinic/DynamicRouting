<?php


namespace Tests\Service;


use Closure;
use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use ElementsFramework\DynamicRouting\Service\RouteClosureProvider;
use Tests\BaseTest;

class RouteClosureProviderTest extends BaseTest
{

    public function testGetClosureById()
    {
        DynamicRoute::create([
            'method' => 'get',
            'name' => 'test',
            'pattern' => '/test',
            'handler' => 'RedirectRouteHandler',
            'configuration' => ['target' => '/'],
        ]);

        $this->assertInstanceOf(Closure::class, RouteClosureProvider::forRouteId(1));
    }

    public function testGetClosureByRoute()
    {
        $dynamicRoute = DynamicRoute::create([
            'method' => 'get',
            'name' => 'test',
            'pattern' => '/test',
            'handler' => 'RedirectRouteHandler',
            'configuration' => ['target' => '/'],
        ]);

        $this->assertInstanceOf(Closure::class, RouteClosureProvider::forRoute($dynamicRoute));
    }
}
