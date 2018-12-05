<?php

namespace Vaggelis\LaravelCasService\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelCasService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelcasservice';
    }
}
