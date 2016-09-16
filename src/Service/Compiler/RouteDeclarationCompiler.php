<?php


namespace ElementsFramework\DynamicRouting\Service\Compiler;


use ElementsFramework\DynamicRouting\Model\DynamicRoute;
use Illuminate\Support\Facades\File;

/**
 * Class RouteDeclarationCompiler
 * @package ElementsFramework\DynamicRouting\Service\Compiler
 */
class RouteDeclarationCompiler
{

    /**
     * Returns a compiled definition for the route entry.
     * @param DynamicRoute $dynamicRoute
     * @return string
     */
    public function compileRoute(DynamicRoute $dynamicRoute)
    {
        $action = 'ElementsFramework\DynamicRouting\Service\RouteClosureProvider::forRouteId('.$dynamicRoute->id.')';
        return 'Route::' . $dynamicRoute->method . '("'.$dynamicRoute->pattern.'", '.$action.')->name("'.$dynamicRoute->name.'");';
    }

    /**
     * Returns the output for the whole dynamic routes file.
     * @return string
     */
    public function compileAllRoutes()
    {
        $routes = DynamicRoute::all();

        $output = "";
        if(!empty(config('dynamic-routing.middleware-group'))) {
            $output .= "Route::group(['middleware' => '".config('dynamic-routing.middleware-group')."'], function () {" . PHP_EOL;
        }
        foreach($routes as $route) {
            $output .= $this->compileRoute($route) . PHP_EOL;
        }
        if(!empty(config('dynamic-routing.middleware-group'))) {
            $output .= "});" . PHP_EOL;
        }

        return $output;
    }

    /**
     * Saves the compiled routes to the file set in the configuration.
     */
    public function compileToFile()
    {
        $contents = $this->compileAllRoutes();
        $contents = "<?php" . PHP_EOL . $contents;
        File::put(base_path(config('dynamic-routing.compiled-routes-path')), $contents);
    }

}