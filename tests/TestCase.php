<?php

namespace JeffersonGoncalves\UsPrivacyVendors\Tests;

use JeffersonGoncalves\PestPluginDatabaseMigrations\LoadsPackageMigrations;
use JeffersonGoncalves\UsPrivacyVendors\UsPrivacyVendorsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use LoadsPackageMigrations;

    protected function getPackageProviders($app): array
    {
        return [
            UsPrivacyVendorsServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'testing');
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadPackageMigrations(UsPrivacyVendorsServiceProvider::class);
    }
}
