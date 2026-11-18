<?php

namespace JeffersonGoncalves\UsPrivacyVendors;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class UsPrivacyVendorsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-us-privacy-vendors')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations();
    }
}
