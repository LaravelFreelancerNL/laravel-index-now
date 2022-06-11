<?php

use Illuminate\Support\Facades\Http;
use LaravelFreelancerNL\LaravelIndexNow\Exceptions\TooManyUrlsException;
use LaravelFreelancerNL\LaravelIndexNow\Facades\IndexNow;

beforeEach(function () {
    $key = IndexNow::generateKey();
    putenv('INDEXNOW_KEY=' . $key);
});

it('submits an url', function () {
    Http::fake();

    $response = IndexNow::submit('https://dejacht.nl');

    expect($response->ok())->toBeTrue();
});

it('submits an url with key location', function () {
    Http::fake();

    putenv('INDEXNOW_KEY_LOCATION=articles');

    $response = IndexNow::submit('https://devechtschool.nl');

    expect($response->ok())->toBeTrue();
});


it('submits multiple urls', function () {
    Http::fake();

    $response = IndexNow::submit([
        'https://dejacht.nl',
        'https://dejacht.nl/fotoquiz/',
        'https://dejacht.nl/jagen/',
        'https://dejacht.nl/jachtvideos/',
    ]);

    expect($response->ok())->toBeTrue();
});

it('can not submit too many urls', function () {
    Http::fake();

    $count = 0;
    $baseUrl = 'https://example.com/';
    $urls = [];

    for ($i = 0; $i <= 10001; $i++) {
        $urls[] = $baseUrl . $i;
    }

    IndexNow::submit($urls);
})->throws(TooManyUrlsException::class);
