<?php

namespace Tests\Service;

use ElementsFramework\DynamicRouting\Service\DynamicRouteMapper;
use Tests\BaseTest;

class DynamicRouteMapperTest extends BaseTest
{

    const ROUTE_FILE = 'test.php';

    public function testRouteMapper()
    {
        config(['dynamic-routing.compiled-routes-path' => self::ROUTE_FILE]);
        file_put_contents(
            base_path(self::ROUTE_FILE),
            '<?php Route::get("/test", function() {})->name("mock.route.for.testing.only");'
        );

        DynamicRouteMapper::mapDynamicRoutes();
        $routeCollection = $this->app['router']->getRoutes();
        $routeCollection->refreshNameLookups();
        $this->assertTrue($routeCollection->hasNamedRoute("mock.route.for.testing.only"));
        $this->assertFalse($routeCollection->hasNamedRoute("should.not.exist"));

        unlink(base_path(self::ROUTE_FILE));
    }

}
