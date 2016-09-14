<?php


namespace ElementsFramework\DynamicRouting\Controller;


use Illuminate\Support\Facades\Route;

class DynamicRouteMapper
{

    /**
     * Plugs all of the compiled dynamic routes into the router.
     */
    public static function mapDynamicRoutes()
    {
        Route::group([
            'middleware' => config('dynamic-routing.middleware-group'),
        ], function ($router) {
            require base_path(config('dynamic-routing.compiled-routes-path'));
        });
    }
}