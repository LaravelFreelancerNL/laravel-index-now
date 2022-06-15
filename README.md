# :package_description

[![Latest Version on Packagist](https://img.shields.io/packagist/v/LaravelFreelancerNL/laravel-index-now.svg?style=flat-square)](https://packagist.org/packages/LaravelFreelancerNL/laravel-index-now)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/LaravelFreelancerNL/laravel-index-now/run-tests?label=tests)](https://github.com/LaravelFreelancerNL/laravel-index-now/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/LaravelFreelancerNL/laravel-index-now/Check%20&%20fix%20styling?label=code%20style)](https://github.com/LaravelFreelancerNL/laravel-index-now/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/LaravelFreelancerNL/laravel-index-now.svg?style=flat-square)](https://packagist.org/packages/LaravelFreelancerNL/laravel-index-now)
<!--delete-->
---
This repo can be used to scaffold a Laravel package. Follow these steps to get started:

1. Press the "Use this template" button at the top of this repo to create a new repo with the contents of this LaravelIndexNow.
2. Run "php ./configure.php" to run a script that will replace all placeholders throughout all the files.
3. Have fun creating your package.
4. If you need help creating a package, consider picking up our <a href="https://laravelpackage.training">Laravel Package Training</a> video course.
---
<!--/delete-->
This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require LaravelFreelancerNL/laravel-index-now
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-index-now-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$variable = new LaravelFreelancerNL\LaravelIndexNow();
echo $variable->echoPhrase('Hello, LaravelFreelancerNL!');
```

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
