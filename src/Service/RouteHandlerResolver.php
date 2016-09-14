<?php


namespace ElementsFramework\DynamicRouting\Service;


use ElementsFramework\DynamicRouting\Exception\HandlerNotFoundException;
use ElementsFramework\DynamicRouting\Handler\AbstractRouteTypeHandler;
use ReflectionClass;

class RouteHandlerResolver
{

    /**
     * Returns the instance of the wanted handler if registered.
     * @param $handlerIdentifier
     * @return AbstractRouteTypeHandler
     * @throws HandlerNotFoundException
     */
    public static function getInstance($handlerIdentifier)
    {
        foreach(config('dynamic-routing.handlers') as $handlerClass) {
            $handlerMetadata = new ReflectionClass($handlerClass);
            if($handlerIdentifier == $handlerMetadata->getShortName()) {
                /** @var AbstractRouteTypeHandler $handler */
                return new $handlerClass();
            }
        }
        throw HandlerNotFoundException::fromIdentifier($handlerIdentifier);
    }

    /**
     * Checks if the handler with the given identifier exists.
     * @param $handlerIdentifier
     * @return bool
     */
    public static function handlerExists($handlerIdentifier)
    {
        foreach(config('dynamic-routing.handlers') as $handlerClass) {
            $handlerMetadata = new ReflectionClass($handlerClass);
            if($handlerIdentifier == $handlerMetadata->getShortName()) {
                return true;
            }
        }

        return false;
    }

}