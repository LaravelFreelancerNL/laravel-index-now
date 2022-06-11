<?php

namespace LaravelFreelancerNL\LaravelIndexNow\Tests;

use LaravelFreelancerNL\LaravelIndexNow\IndexNowServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            IndexNowServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
    }
}
