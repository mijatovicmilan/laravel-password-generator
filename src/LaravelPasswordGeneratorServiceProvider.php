<?php

namespace MijatovicMilan\LaravelPasswordGenerator;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use MijatovicMilan\LaravelPasswordGenerator\Commands\LaravelPasswordGeneratorCommand;

class LaravelPasswordGeneratorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-password-generator')
            ->hasConfigFile();
    }
}
