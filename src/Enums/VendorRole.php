<?php

namespace JeffersonGoncalves\UsPrivacyVendors\Enums;

enum VendorRole: string
{
    /** Processes personal data on your behalf, under a binding contract (every state). */
    case Processor = 'processor';

    /** Anyone else you disclose personal data to: list them in the privacy notice. */
    case ThirdParty = 'third_party';

    /** Whether the state laws require a written contract with this role. */
    public function requiresContract(): bool
    {
        return $this === self::Processor;
    }

    /**
     * Contract terms this role requires: config('us-privacy-vendors.checklist.<role>').
     *
     * @return array<string, string>
     */
    public function checklist(): array
    {
        return (array) config("us-privacy-vendors.checklist.{$this->value}", []);
    }
}
