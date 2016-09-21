<?php

namespace Tests\Console;

use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use Illuminate\Support\Facades\Artisan;
use Tests\BaseTest;

class CleanupProvidedRoutesCommandTest extends BaseTest
{

    public function testCommand()
    {
        $route = DynamicRoute::create([
            'method' => 'get',
            'name' => 'test',
            'pattern' => '/test',
            'handler' => 'RedirectRouteHandler',
            'configuration' => ['target' => '/'],
        ]);
        $route->userspace = false;
        $route->save();

        $this->artisan('dynamic-route:provided:cleanup');

        $this->assertTrue(true);
    }

}
