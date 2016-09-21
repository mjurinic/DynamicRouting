<?php

namespace Tests\Model;

use ElementsFramework\DynamicRouting\Exception\BasicValidationFailedForRouteException;
use ElementsFramework\DynamicRouting\Exception\HandlerNotFoundException;
use ElementsFramework\DynamicRouting\Exception\HandlerValidationFailedForRouteException;
use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use Tests\BaseTest;

class DynamicRouteTest extends BaseTest
{

    public function testCreateWithoutRequiredParameters()
    {
        $this->expectException(BasicValidationFailedForRouteException::class);
        DynamicRoute::create([]);
    }

    public function testCreateWithoutExistingHandler()
    {
        $this->expectException(HandlerNotFoundException::class);
        DynamicRoute::create([
            'method' => 'get',
            'name' => 'test',
            'pattern' => '/test',
            'handler' => 'NonExistentHandler'
        ]);
    }

    public function testCreateWithoutHandlerParameters()
    {
        $this->expectException(HandlerValidationFailedForRouteException::class);
        DynamicRoute::create([
            'method' => 'get',
            'name' => 'test',
            'pattern' => '/test',
            'handler' => 'ControllerActionRouteHandler'
        ]);
    }

    public function testSuccessfulCreate()
    {
        $route = DynamicRoute::create([
            'method' => 'get',
            'name' => 'test',
            'pattern' => '/test',
            'handler' => 'RedirectRouteHandler',
            'configuration' => ['target' => '/'],
        ]);

        $this->assertNotNull($route->id);
    }

}
