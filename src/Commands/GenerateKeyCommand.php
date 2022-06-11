<?php

declare(strict_types=1);

namespace LaravelFreelancerNL\LaravelIndexNow\Commands;

use Illuminate\Console\Command;
use LaravelFreelancerNL\LaravelIndexNow\Facades\IndexNow;

class GenerateKeyCommand extends Command
{
    public $signature = 'index-now:generate-key';

    public $description = 'Generate the key and key file required for index submissions.';

    public function handle(): int
    {
        IndexNow::generateKey();

        return self::SUCCESS;
    }
}
