<?php

namespace Acacha\LaravelSocial\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class LaravelSocial.
 */
class LaravelSocial extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'LaravelSocial';
    }
}
