<?php

namespace JeffersonGoncalves\UsPrivacyVendors\Tests;

use JeffersonGoncalves\UsPrivacyVendors\UsPrivacyVendorsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            UsPrivacyVendorsServiceProvider::class,
        ];
    }
}
