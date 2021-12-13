# This is my package iss-vendas

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bildvitta/iss-vendas.svg?style=flat-square)](https://packagist.org/packages/bildvitta/iss-vendas)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/bildvitta/iss-vendas/Check%20&%20fix%20styling?label=code%20style)](https://github.com/bildvitta/iss-vendas/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bildvitta/iss-vendas.svg?style=flat-square)](https://packagist.org/packages/bildvitta/iss-vendas)

## Installation

You can install the package via composer:

```bash
composer require bildvitta/iss-vendas
```

You can publish the config file with:
```bash
php artisan vendor:publish --tag="vendas-config"
```

This is the contents of the published config file:

```php
return [
    'base_uri' => env('MS_VENDAS_BASE_URI', 'https://api-dev-vendas.nave.dev'),
    'prefix' => env('MS_VENDAS_API_PREFIX', '/api')
];
```

## Usage

```php
$vendas = new Bildvitta\IssVendas\IsseVendas();
dd($vendas->programmatic()->sale()->find('95c17b9b-a839-4bc7-89c0-6d23c54641a1'));
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [BILD\jean.garcia](https://github.com/SOSTheBlack)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
