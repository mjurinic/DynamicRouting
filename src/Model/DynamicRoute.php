<?php


namespace ElementsFramework\DynamicRouting\Model;


use ElementsFramework\DynamicRouting\Exception\BasicValidationFailedForRouteException;
use ElementsFramework\DynamicRouting\Exception\HandlerNotFoundException;
use ElementsFramework\DynamicRouting\Exception\HandlerValidationFailedForRouteException;
use ElementsFramework\DynamicRouting\Service\RouteHandlerResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class DynamicRoute extends Model
{

    /**
     * Mass assignment protection - fillable fields
     * @var array
     */
    protected $fillable = [
        'method',
        'name',
        'pattern',
        'handler',
        'configuration'
    ];

    /**
     * Validation rules.
     * @var array
     */
    public static $validation = [
        'method' => ['required'],
        'name' => ['required'],
        'pattern' => ['required'],
        'handler' => ['required']
    ];

    /**
     * @var array
     */
    protected $casts = [
        'configuration' => 'array',
    ];

    /**
     * Saves the route if valid.
     * @param array $options
     * @return bool
     * @throws BasicValidationFailedForRouteException
     * @throws HandlerNotFoundException
     * @throws HandlerValidationFailedForRouteException
     */
    public function save(array $options = [])
    {
        $validator = Validator::make($this->toArray(), self::$validation);
        if($validator->fails()) {
            throw BasicValidationFailedForRouteException::fromRoute($this);
        }
        if(RouteHandlerResolver::handlerExists($this->handler) === false) {
            throw HandlerNotFoundException::fromIdentifier($this->handler);
        }
        if(RouteHandlerResolver::getInstance($this->handler)->isValid($this) === false) {
            throw HandlerValidationFailedForRouteException::fromRoute($this);
        }

        return parent::save($options);
    }

}