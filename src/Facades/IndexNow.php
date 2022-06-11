<?php

namespace LaravelFreelancerNL\LaravelIndexNow\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaravelFreelancerNL\LaravelIndexNow\LaravelIndexNow
 */
class IndexNow extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'index-now';
    }
}
