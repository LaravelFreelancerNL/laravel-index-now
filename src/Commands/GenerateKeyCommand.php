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
        $key = IndexNow::generateKey();

        $this->info('The keyfile was generated. Please add the following key to your .env file:');
        $this->newLine();
        $this->info('INDEXNOW_KEY=' . $key);

        return self::SUCCESS;
    }
}
