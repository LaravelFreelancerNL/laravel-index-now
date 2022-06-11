<?php

declare(strict_types=1);

namespace LaravelFreelancerNL\LaravelIndexNow;

use LaravelFreelancerNL\LaravelIndexNow\Commands\GenerateKeyCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class IndexNowServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('index-now')
            ->hasConfigFile('index-now')
            ->hasCommand(GenerateKeyCommand::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     * @throws \Spatie\LaravelPackageTools\Exceptions\InvalidPackage
     */
    public function register()
    {
        parent::register();

        $this->app->bind(
            'index-now',
            'LaravelFreelancerNL\LaravelIndexNow\IndexNow'
        );
    }
}
