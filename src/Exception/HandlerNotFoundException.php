<?php

namespace ElementsFramework\DynamicRouting\Exception;

use Exception;

class HandlerNotFoundException extends Exception
{

    public static function fromIdentifier($identifier)
    {
        return new self("Could not found a handler with the '$identifier' identifier. Did you forget to register it in the dynamic router configuration file?");
    }

}