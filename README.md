# Laravel IndexNow
Submit pages to search engines

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-freelancer-nl/laravel-index-now.svg?style=flat-square)](https://packagist.org/packages/laravel-freelancer-nl/laravel-index-now)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/LaravelFreelancerNL/laravel-index-now/run-tests?label=tests)](https://github.com/LaravelFreelancerNL/laravel-index-now/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/LaravelFreelancerNL/laravel-index-now/Check%20&%20fix%20styling?label=code%20style)](https://github.com/LaravelFreelancerNL/laravel-index-now/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-freelancer-nl/laravel-index-now.svg?style=flat-square)](https://packagist.org/packages/laravel-freelancer-nl/laravel-index-now)

This packages provides a wrapper to use the IndexNow api in Laravel. This makes indexing new webpages in (some) search 
engines easy and fast. It makes for a nice little addition to sitemaps.

[IndexNow](https://www.indexnow.org) is an API created by Microsoft Bing & Yandex to allow you to submit page changes
to their search engines quickly.  A submission to one search engine will automatically pass the submission on to the 
others.

At the time of this writing Google is considering supporting the API 
and [has announced it will be testing it](https://www.searchenginejournal.com/google-will-be-testing-indexnow/426602/).

## Installation

You can install the package via composer:

```bash
composer require laravel-freelancer-nl/laravel-index-now
```

You can publish the config file with:
```bash
php artisan vendor:publish --tag="index-now-config"
```

This is the contents of the published config file:

```php
return [
    'host' => env('APP_URL', 'localhost'),
    'key' => env('INDEXNOW_KEY', ''),
    'key-location' => env('INDEXNOW_KEY_LOCATION', ''),
    'log-failed-submits' => env('INDEXNOW_LOG_FAILED_SUBMITS', true),
    'production-env' => env('INDEXNOW_PRODUCTION_ENV', 'production'),
    'search-engine' => env('INDEXNOW_SEARCH_ENGINE', 'api.indexnow.org'),
    'delay' => env('INDEXNOW_SUBMIT_DELAY', 600),
];
```
- _host_: the domain for which you will submit pages to the search engine 
- _key_: the unique key for this domain (you will generate one in the next step)
- _key-location_: the directory and/or prefix to the key file
- _log-failed-submits_: disable logging of submit attempts in non-production environments
- _production-env_: the name of the production environment; 
- _search-engine_: the domain of the specific search engine you wish to submit too. 
- _delay_: the delay in seconds for delayed page submissions.

### Generate a new key
The IndexNow API matches the request key to a key file within the host domain. 
To generate the keyfile you use the following artisan command:

```bash
php artisan index-now:generate-key
```
This will create a keyfile in the public_dir() of your project and output the key.
Copy the displayed key and place it in your .env file.

If you've set a key location in the config it will be prefixed to the file.

Running this command multiple times will generate a new key and key file.

### Only submit pages for your production environment
You probably don't want to submit pages in any environment other than production. 

By default, this package assumes that your production environment is called 'production' and will only submit when it 
matches the configured name in the package.

In the case of an environment mismatch it will log a submission 'attempt' instead of actually submitting the page to 
the search engines.

If you use an alternative name for your production environment you can set INDEXNOW_PRODUCTION_ENV in your .env 
to match. 

You can disable this by setting INDEXNOW_PRODUCTION_ENV to false.

## Usage
You can submit one or more pages per request by calling the facade and passing the url(s) to the submit method.

Note that the urls must be fully qualified without query parameters and without a fragment.

### Submit a single page
```php
use LaravelFreelancerNL\LaravelIndexNow\Facades\IndexNow;

IndexNow::submit('https://dejacht.nl/jagen');
```

### Submit a multiple pages
To submit multiple pages at once just add an array of urls.

```php
use LaravelFreelancerNL\LaravelIndexNow\Facades\IndexNow;

IndexNow::submit([
    'https://dejacht.nl',
    'https://dejacht.nl/fotoquiz/',
    'https://dejacht.nl/jagen/',
    'https://dejacht.nl/jachtvideos/',
]);
```

### Prevent spam: delay page submissions
You can delay page submissions by using the delaySubmission method.
This dispatches the IndexNowSubmitJob with a delay in seconds as configured. The job is unique by payload,
so multiple submissions of the same urls won't push a job to the queue before the current one is handled.

```php
use LaravelFreelancerNL\LaravelIndexNow\Facades\IndexNow;

IndexNow::delaySubmission('https://devechtschool.nl');
```

You can override the configured default delay by adding your own.
```php
use LaravelFreelancerNL\LaravelIndexNow\Facades\IndexNow;

IndexNow::delaySubmission('https://devechtschool.nl', 100);
```

#### When to delay submits
It isn't uncommon for people to make additional edits after creating or updating a page. On these actions it is a good idea to delay
the submission.

When deleting pages you can just submit the urls immediately.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Bas](https://github.com/LaravelFreelancerNL)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
