<?php

namespace MijatovicMilan\LaravelPasswordGenerator;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelPasswordGeneratorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-password-generator')
            ->hasConfigFile();
    }
}
