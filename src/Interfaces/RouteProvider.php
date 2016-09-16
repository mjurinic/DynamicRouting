<?php


namespace ElementsFramework\DynamicRouting\Interfaces;


use ElementsFramework\DynamicRouting\Model\DynamicRoute;

interface RouteProvider
{

    /**
     * Returns an array of unpersisted DynamicRoute objects which will
     * be created if they already don't exist.
     * @return DynamicRoute[]
     */
    public static function getDefaultDynamicRoutes();

}