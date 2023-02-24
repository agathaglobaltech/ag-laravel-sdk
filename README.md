# Laravel API wrapper for Annuities Genius

[![Latest Version on Packagist](https://img.shields.io/packagist/v/agathaglobaltech/ag-laravel-sdk.svg?style=flat-square)](https://packagist.org/packages/agathaglobaltech/ag-laravel-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/agathaglobaltech/ag-laravel-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/agathaglobaltech/ag-laravel-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/agathaglobaltech/ag-laravel-sdk/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/agathaglobaltech/ag-laravel-sdk/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/agathaglobaltech/ag-laravel-sdk.svg?style=flat-square)](https://packagist.org/packages/agathaglobaltech/ag-laravel-sdk)

This is a Laravel API wrapper for Annuities Genius. It provides a simple way to interact with the Annuities Genius API.

## Installation

You can install the package via composer:

```bash
composer require agathaglobaltech/ag-laravel-sdk
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="sdk-config"
```

This is the contents of the published config file:

```php
return [
    'token' => env('ANNUITIES_GENIUS_TOKEN'),

    'base_url' => env('ANNUITIES_GENIUS_BASE_URL', 'https://app.annuitiesgenius.com/api'),

    'cache' => [
        'enabled' => env('ANNUITIES_GENIUS_CACHE_ENABLED', false),
        'hours' => 24,
    ],
];
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
