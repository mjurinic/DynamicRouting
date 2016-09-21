<?php

namespace Tests\Service\Compiler;

use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use ElementsFramework\DynamicRouting\Service\Compiler\RouteDeclarationCompiler;
use Tests\BaseTest;

class RouteDeclarationCompilerTest extends BaseTest
{

    const ROUTE_FILE = 'test.php';

    public function setUp()
    {
        parent::setUp();

        DynamicRoute::create([
            'method' => 'get',
            'name' => 'test',
            'pattern' => '/test',
            'handler' => 'RedirectRouteHandler',
            'configuration' => ['target' => '/'],
        ]);
    }

    public function testCompileToFile()
    {
        config(['dynamic-routing.compiled-routes-path' => self::ROUTE_FILE]);
        $compiler = new RouteDeclarationCompiler();
        $compiler->compileToFile();

        $this->assertFileExists(base_path(self::ROUTE_FILE));
        $output = file_get_contents(base_path(self::ROUTE_FILE));
        $expectedOutput = <<<PHP
<?php
Route::group(['middleware' => 'web'], function () {
Route::get("/test", ElementsFramework\DynamicRouting\Service\RouteClosureProvider::forRouteId(1))->name("test");
});

PHP;
        $this->assertEquals($expectedOutput, $output);

        unlink(base_path(self::ROUTE_FILE));
    }

}
