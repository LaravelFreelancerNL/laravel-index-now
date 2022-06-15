<?php

declare(strict_types=1);

use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use LaravelFreelancerNL\LaravelIndexNow\Exceptions\TooManyUrlsException;
use LaravelFreelancerNL\LaravelIndexNow\Facades\IndexNow;
use LaravelFreelancerNL\LaravelIndexNow\Jobs\SubmitUrlJob;

beforeEach(function () {
    config(['index-now.key' => Str::uuid()->toString()]);
});

it('submits an url', function () {
    Http::fake();

    $response = IndexNow::submit('https://dejacht.nl');

    expect($response->ok())->toBeTrue();

    Http::assertSent(function (Request $request) {
        return $request->url() == 'https://api.indexnow.org/indexnow?key='
            . config('index-now.key')
            . '&url=' . urlencode('https://dejacht.nl');
    });
});

it('submits an url with key location', function () {
    Http::fake();

    config(['index-now.key-location' =>'index-now-']);

    IndexNow::generateKey();

    $response = IndexNow::submit('https://devechtschool.nl');

    expect($response->ok())->toBeTrue();

    Http::assertSent(function (Request $request) {
        return $request->url() == 'https://api.indexnow.org/indexnow?key='
            . config('index-now.key')
            . '&keyLocation=' . config('index-now.key-location')
            . '&url=' . urlencode('https://devechtschool.nl');
    });

});


it('submits multiple urls', function () {
    Http::fake();

    config(['index-now.key-location' =>'index-now-']);

    $urls = [
        'https://dejacht.nl',
        'https://dejacht.nl/fotoquiz/',
        'https://dejacht.nl/jagen/',
        'https://dejacht.nl/jachtvideos/',
    ];

    $preparedUrls = Arr::map($urls, function ($value) {
        return urlencode($value);
    });

    $response = IndexNow::submit($urls);

    expect($response->ok())->toBeTrue();

    config(['index-now.key', Str::uuid()]);
    config(['index-now.key-location', 'index-now-']);


    Http::assertSent(function (Request $request) use ($preparedUrls) {
        return $request->method() == 'POST' &&
            $request->url() == 'https://api.indexnow.org/indexnow' &&
            $request['host'] == 'localhost' &&
            $request['key'] == config('index-now.key') &&
            $request['keyLocation'] == config('index-now.key-location') &&
            $request['urlList'] == $preparedUrls;
    });
});

it('can not submit too many urls', function () {
    Http::fake();

    $baseUrl = 'https://example.com/';
    $urls = [];

    for ($i = 0; $i <= 10001; $i++) {
        $urls[] = $baseUrl . $i;
    }

    IndexNow::submit($urls);
})->throws(TooManyUrlsException::class);

it('delays a submit', function () {
    Http::fake();
    Bus::fake();

    $response = IndexNow::delaySubmission('https://devechtschool.nl');

    expect($response)->toBeInstanceOf(PendingDispatch::class);
    Bus::assertNotDispatchedSync(SubmitUrlJob::class);
});

it('delays a submit for 0 seconds...', function () {
    Http::fake();
    Bus::fake();

    IndexNow::delaySubmission('https://devechtschool.nl', 0);

    Bus::assertDispatched(SubmitUrlJob::class);
});
