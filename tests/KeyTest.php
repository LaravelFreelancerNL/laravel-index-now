<?php

use Illuminate\Support\Facades\File;
use LaravelFreelancerNL\LaravelIndexNow\Facades\IndexNow;

it('generates a key file', function () {
    $key = IndexNow::generateKey();
    $path = public_path($key . '.txt');

    $contents = File::get($path);

    expect($contents)->toBe($key);
});

it('has a key generation command', function () {
    $this->artisan('index-now:generate-key')->assertExitCode(0);
});
