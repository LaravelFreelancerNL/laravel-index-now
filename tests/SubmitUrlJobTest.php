<?php

declare(strict_types=1);

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use LaravelFreelancerNL\LaravelIndexNow\Jobs\SubmitUrlJob;

beforeEach(function () {
    config(['index-now.key' => Str::uuid()->toString()]);
});

it('handles the job', function () {
    Http::fake();

    (new SubmitUrlJob('https://laravel-freelancer.nl'))->handle();

    Http::assertSent(function (Request $request) {
        return $request->url() == 'https://api.indexnow.org/indexnow?key='
            . config('index-now.key')
            . '&url=' . urlencode('https://laravel-freelancer.nl');
    });
});
