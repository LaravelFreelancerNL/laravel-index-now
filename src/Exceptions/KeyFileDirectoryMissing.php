<?php

declare(strict_types=1);

namespace LaravelFreelancerNL\LaravelIndexNow\Exceptions;

use Exception;

class KeyFileDirectoryMissing extends Exception
{
    /** @phpstan-ignore-next-line  */
    protected $code = 404;

    /** @phpstan-ignore-next-line  */
    protected $message = 'The key location directory does not exist.';
}
