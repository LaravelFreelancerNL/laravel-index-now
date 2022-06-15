<?php

declare(strict_types=1);

namespace LaravelFreelancerNL\LaravelIndexNow\Facades;

use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Facade;

/**
 * @see \LaravelFreelancerNL\LaravelIndexNow\LaravelIndexNow
 *
 * @method string generateKey()
 * @method string getKeyFileName()
 * @method Response submit(string|array $url)
 * @method PendingDispatch delaySubmission(string|array $url, int $delayInSeconds = null)
 */
class IndexNow extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'index-now';
    }
}
