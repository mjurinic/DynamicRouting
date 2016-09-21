<?php


namespace ElementsFramework\DynamicRouting\Service\Publishing;


use ElementsFramework\DynamicRouting\Interfaces\RouteProvider;
use ElementsFramework\DynamicRouting\Model\DynamicRoute;

/**
 * Handles the adding and removing of routes published by other Elements components.
 * Class RoutePublisher
 * @package ElementsFramework\DynamicRouting\Service\Publishing
 */
class RoutePublisher
{

    /**
     * Returns an array of DynamicRoutes with keys being their name.
     * @return \ElementsFramework\DynamicRouting\Model\DynamicRoute[]
     */
    protected function getStoredProvidedRoutes()
    {
        $routes = DynamicRoute::where('userspace', false)->get();
        $routes = array_combine($routes->pluck('name')->toArray(), $routes->all());

        return $routes;
    }

    /**
     * Creates all published route that have not been already created and returns them.
     * @return \ElementsFramework\DynamicRouting\Model\DynamicRoute[]
     * @throws \ElementsFramework\DynamicRouting\Exception\HandlerNotFoundException
     * @throws \ElementsFramework\DynamicRouting\Exception\HandlerValidationFailedForRouteException
     */
    public function publishProvidedRoutes()
    {
        $existingRoutes = $this->getStoredProvidedRoutes();
        $published = [];

        /** @var RouteProvider $provider */
        foreach(config('dynamic-routing.route-providers') as $provider) {
            foreach($provider::getDefaultDynamicRoutes() as $providedRoute) {
                if(key_exists($providedRoute->name, $existingRoutes) === false) {
                    $providedRoute->userspace = 0;
                    $providedRoute->save();
                    $published[] = $providedRoute;
                }
            }
        }

        return $published;
    }

    /**
     * Deletes all routes that are not published anymore and returns the deleted routes.
     * @return \ElementsFramework\DynamicRouting\Model\DynamicRoute[]
     * @throws \Exception
     */
    public function cleanupProvidedRoutes()
    {
        $existingRoutes = $this->getStoredProvidedRoutes();

        /** @var RouteProvider $provider */
        foreach(config('dynamic-routing.route-providers') as $provider) {
            foreach($provider::getDefaultDynamicRoutes() as $providedRoute) {
                unset($existingRoutes[$providedRoute->name]);
            }
        }

        $deletedRoutes = $existingRoutes;
        foreach($existingRoutes as $route) {
            $route->delete();
        }

        return $deletedRoutes;
    }

    /**
     * Publishes all new, and deletes all removed provided routes.
     */
    public function syncProvidedRoutes()
    {
        $this->publishProvidedRoutes();
        $this->cleanupProvidedRoutes();
    }



}