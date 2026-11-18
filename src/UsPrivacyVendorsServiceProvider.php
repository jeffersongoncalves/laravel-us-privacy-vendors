<?php

namespace JeffersonGoncalves\UsPrivacyVendors;

use JeffersonGoncalves\UsPrivacyVendors\Commands\VendorsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class UsPrivacyVendorsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('us-privacy-vendors')
            ->hasConfigFile()
            ->hasMigrations(['create_us_privacy_vendors_table'])
            ->hasCommand(VendorsCommand::class);
    }
}
