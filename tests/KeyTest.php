<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;
use LaravelFreelancerNL\LaravelIndexNow\Exceptions\KeyFileDirectoryMissing;
use LaravelFreelancerNL\LaravelIndexNow\Facades\IndexNow;

it('generates a key file', function () {
    $key = IndexNow::generateKey();

    $path = public_path($key.'.txt');
    $contents = File::get($path);

    expect($contents)->toBe($key);
});

it('generates a key file at a specific location', function () {
    $keyLocation = 'indexnow-';
    config(['index-now.key-location' => $keyLocation]);

    $key = IndexNow::generateKey();

    $path = public_path($keyLocation.$key.'.txt');

    $contents = File::get($path);

    expect($contents)->toBe($key);
});

it('generates a key file in a subdirectory', function () {
    $keyLocation = 'articles/';

    if (! file_exists(public_path($keyLocation))) {
        mkdir(public_path($keyLocation));
    }

    config(['index-now.key-location' => $keyLocation]);

    $key = IndexNow::generateKey();

    $path = public_path($keyLocation.$key.'.txt');

    $contents = File::get($path);

    expect($contents)->toBe($key);
});

it('can not generate a key file in non-existing directory', function () {
    $keyLocation = 'this-directory-does-not-exist/';

    config(['index-now.key-location' => $keyLocation]);

    IndexNow::generateKey();
})->throws(KeyFileDirectoryMissing::class);

it('has a key generation command', function () {
    $this->artisan('index-now:generate-key')->assertExitCode(0);
});

it('outputs the new key', function () {
    $this->artisan('index-now:generate-key')
        ->expectsOutput('The keyfile was generated. Please add the following key to your .env file:');
});
