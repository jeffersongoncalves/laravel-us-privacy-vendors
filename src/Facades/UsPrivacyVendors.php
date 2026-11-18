<?php

namespace JeffersonGoncalves\UsPrivacyVendors\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JeffersonGoncalves\UsPrivacyVendors\UsPrivacyVendors
 */
class UsPrivacyVendors extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-us-privacy-vendors';
    }
}
