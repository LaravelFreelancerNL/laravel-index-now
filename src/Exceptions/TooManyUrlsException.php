<?php

declare(strict_types=1);

namespace LaravelFreelancerNL\LaravelIndexNow\Exceptions;

use Exception;

class TooManyUrlsException extends Exception
{
    /** @phpstan-ignore-next-line  */
    protected $code = 413;

    /** @phpstan-ignore-next-line  */
    protected $message = "You can't submit more than 10.000 urls in one batch.";
}
