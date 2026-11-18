<?php

namespace JeffersonGoncalves\UsPrivacyVendors\Enums;

enum VendorIssue: string
{
    case AgreementMissing = 'agreement_missing';
    case AgreementExpired = 'agreement_expired';
    case AgreementIncomplete = 'agreement_incomplete';
    case ReviewDue = 'review_due';
    case DataReturnPending = 'data_return_pending';

    public function description(): string
    {
        return match ($this) {
            self::AgreementMissing => 'No signed contract',
            self::AgreementExpired => 'The contract has expired',
            self::AgreementIncomplete => 'The contract misses required terms',
            self::ReviewDue => 'Periodic review is due',
            self::DataReturnPending => 'Relationship ended, data deletion or return not confirmed',
        };
    }
}
