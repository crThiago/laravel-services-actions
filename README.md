# Laravel Services and Actions Package

This package is designed to help developers generate the Services and Actions layer in their Laravel applications.
It provides a set of commands to generate the necessary files and folders, as well as a template for the Service and
Action classes.
 
## Installation
To install the package, use Composer:
```bash
composer require --dev crthiago/laravel-services-actions
```

## Configuration
To publish the configuration file, run the following command:
```bash
php artisan vendor:publish --provider="services-actions-config"
```

## Usage
To generate a Service, run the following command:
```bash
php artisan make:service <model>
```

To generate an Action, run the following command:
```bash
php artisan make:action <name>
```

## Contribution
Contributions to the Laravel Services and Actions package are welcome! 

If you find a bug or have a feature request, please create a new issue. 
If you would like to contribute code, please create a new pull request with your changes. 
Thank you for your interest!

## License
The Laravel Services and Actions package is open-sourced software licensed under the [MIT license](https://opensource.org/license/mit/).
