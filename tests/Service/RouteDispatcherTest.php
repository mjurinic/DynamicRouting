<?php


namespace Tests\Service;


use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use ElementsFramework\DynamicRouting\Service\RouteDispatcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Tests\BaseTest;

class RouteDispatcherTest extends BaseTest
{

    public function testRouteDispatch()
    {
        $route = new DynamicRoute();
        $route->fill([
            'name' => 'test',
            'pattern' => '/test',
            'method' => 'get',
            'handler' => 'RedirectRouteHandler',
            'configuration' => ['target' => 'http://google.com'],
        ]);

        $dispatcher = new RouteDispatcher();
        $response = $dispatcher->dispatchRouteToHandler(new Request(), $route);

        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

}
