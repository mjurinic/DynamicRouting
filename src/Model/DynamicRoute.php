<?php


namespace ElementsFramework\DynamicRouting\Model;


use Illuminate\Database\Eloquent\Model;

class DynamicRoute extends Model
{

    /**
     * Mass assignment protection - fillable fields
     * @var array
     */
    protected $fillable = [
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
        'name' => ['required'],
        'pattern' => ['required'],
        'handler' => ['required'],
        'configuration' => ['required', 'json']
    ];

}