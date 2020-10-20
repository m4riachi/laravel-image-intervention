# Image Resizer

[![Latest Version on Packagist](https://img.shields.io/packagist/v/m4riachi/laravel-image-intervention.svg?style=flat-square)](https://packagist.org/packages/m4riachi/laravel-image-intervention)
[![Build Status](https://img.shields.io/travis/m4riachi/laravel-image-intervention/master.svg?style=flat-square)](https://travis-ci.org/m4riachi/laravel-image-intervention)
[![Quality Score](https://img.shields.io/scrutinizer/g/m4riachi/laravel-image-intervention.svg?style=flat-square)](https://scrutinizer-ci.com/g/m4riachi/laravel-image-intervention)
[![Total Downloads](https://img.shields.io/packagist/dt/m4riachi/laravel-image-intervention.svg?style=flat-square)](https://packagist.org/packages/m4riachi/laravel-image-intervention)

A simple helper who use Image Intervention to resize images

## Installation

You can install the package via composer:

```bash
composer require m4riachi/laravel-image-intervention
```

## Usage

``` php
LaravelImageIntervention::resize($imagePath, 300, 300, [
    'crop' => false,
    'quality' => 90
])
```


### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email taoufiq.benmessaoud@gmail.com instead of using the issue tracker.

## Credits

- [m4riachi](https://github.com/m4riachi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
