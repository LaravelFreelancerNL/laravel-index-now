<?php

declare(strict_types=1);

namespace LaravelFreelancerNL\LaravelIndexNow\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use LaravelFreelancerNL\LaravelIndexNow\Facades\IndexNow;

class IndexNowSubmitJob implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var string|string[]
     */
    protected array|string $urls;

    /**
     * @param string|string[] $urls
     */
    public function __construct(array|string $urls)
    {
        $this->urls = $urls;
    }

    public function handle(): void
    {
        IndexNow::submit($this->urls);
    }

    /**
     * The unique ID of the job.
     *
     * @return string
     */
    public function uniqueId()
    {
        return md5((string) json_encode($this->urls));
    }
}
