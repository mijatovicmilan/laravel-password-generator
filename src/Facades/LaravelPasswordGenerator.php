<?php

namespace MijatovicMilan\LaravelPasswordGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MijatovicMilan\LaravelPasswordGenerator\LaravelPasswordGenerator
 */
class LaravelPasswordGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-password-generator';
    }
}
