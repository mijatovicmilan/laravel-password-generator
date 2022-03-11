# Generate secure password.

## Installation

You can install the package via composer:

```bash
composer require mijatovicmilan/laravel-password-generator
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="password-generator-config"
```

This is the contents of the published config file:

```php
return [
    // Minimum password length
    "minimum_password_length" => 6,

    // If password length is not passed we will use this length instead
    "default_password_length" => 6,

    // If password strength is not passed we will use this strength instead
    "default_password_strength" => 2,
];
```

## Usage
GeneratePassword action accept 2 parameters, both parameters are optinal. First parameter is password length, if left empty we will use length defined in config. Second parameter is password strength, if left empty we will use strength defined in config file.
```php
use MijatovicMilan\LaravelPasswordGenerator\Actions\GeneratePassword;

$password = (new GeneratePassword)(12, 2);
```
or
```php
use MijatovicMilan\LaravelPasswordGenerator\Actions\GeneratePassword;

public function something(GeneratePassword $generatePassword) {
    $password = $generatePassword();
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
