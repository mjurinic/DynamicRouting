<?php

namespace Tests\Service;

use ElementsFramework\DynamicRouting\Exception\HandlerNotFoundException;
use ElementsFramework\DynamicRouting\Handler\AbstractRouteTypeHandler;
use ElementsFramework\DynamicRouting\Service\RouteHandlerResolver;
use Tests\BaseTest;

class RouteHandlerResolverTest extends BaseTest
{

    const INVALID_HANDLER = 'MockHandler';
    const VALID_HANDLER = 'RedirectRouteHandler';

    public function testHandlerExistsInvalid()
    {
        $this->assertFalse(RouteHandlerResolver::handlerExists(self::INVALID_HANDLER));
    }

    public function testHandlerExistsValid()
    {
        $this->assertTrue(RouteHandlerResolver::handlerExists(self::VALID_HANDLER));
    }

    public function testHandlerInstanceInvalid()
    {
        $this->expectException(HandlerNotFoundException::class);
        RouteHandlerResolver::getInstance(self::INVALID_HANDLER);
    }

    public function testHandlerInstanceValid()
    {
        $handler = RouteHandlerResolver::getInstance(self::VALID_HANDLER);
        $this->assertInstanceOf(AbstractRouteTypeHandler::class, $handler);
    }
}
