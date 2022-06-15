<?php

declare(strict_types=1);

namespace LaravelFreelancerNL\LaravelIndexNow\Exceptions;

use Exception;

class KeyFileDirectoryMissing extends Exception
{
    protected $code = 413;

    protected $message = "The key location directory does not exist.";
}
