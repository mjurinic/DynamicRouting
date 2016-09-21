<?php

namespace Tests\Service\Publishing;

use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use ElementsFramework\DynamicRouting\Service\Publishing\RoutePublisher;
use Tests\BaseTest;

class RoutePublisherTest extends BaseTest
{

    public function testRoutePublish()
    {
        config(['dynamic-routing.route-providers' => [MockRouteProvider::class]]);

        $publisher = new RoutePublisher();
        $publishedRoutes = $publisher->publishProvidedRoutes();
        $this->assertEquals(1, count($publishedRoutes));
        $this->assertEquals(1, DynamicRoute::get()->count());
    }

    public function testRouteCleanup()
    {
        config(['dynamic-routing.route-providers' => [MockRouteProvider::class]]);

        $publisher = new RoutePublisher();

        $publishedRoutes = $publisher->publishProvidedRoutes();
        $this->assertEquals(1, count($publishedRoutes));

        config(['dynamic-routing.route-providers' => []]);

        $deletedRoutes = $publisher->cleanupProvidedRoutes();
        $this->assertEquals(1, count($deletedRoutes));
        $this->assertEquals(0, DynamicRoute::get()->count());
    }

    public function testRouteSync()
    {
        config(['dynamic-routing.route-providers' => [MockRouteProvider::class]]);

        $publisher = new RoutePublisher();
        $publisher->syncProvidedRoutes();
        $this->assertEquals(1, DynamicRoute::get()->count());
    }
}
