<?php

use Illuminate\Support\Facades\Artisan;
use JeffersonGoncalves\UsPrivacyVendors\Enums\VendorIssue;
use JeffersonGoncalves\UsPrivacyVendors\Enums\VendorRisk;
use JeffersonGoncalves\UsPrivacyVendors\Enums\VendorRole;
use JeffersonGoncalves\UsPrivacyVendors\Models\Vendor;

function fullChecklist(VendorRole $role): array
{
    return array_fill_keys(array_keys($role->checklist()), true);
}

it('flags a processor without a contract, then with missing terms', function () {
    $vendor = Vendor::create(['name' => 'Stripe', 'role' => VendorRole::Processor]);

    expect($vendor->issues())->toBe([VendorIssue::AgreementMissing]);

    $vendor->update(['dpa_signed_at' => now(), 'dpa_checklist' => ['instructions' => true]]);

    expect($vendor->issues())->toBe([VendorIssue::AgreementIncomplete])
        ->and($vendor->missingChecklistItems())->toContain('confidentiality', 'delete_or_return', 'subcontractors')->not->toContain('instructions');

    $vendor->update(['dpa_checklist' => fullChecklist(VendorRole::Processor)]);

    expect($vendor->issues())->toBe([]);
});

it('requires no contract with a third party, but tracks one you signed', function () {
    $vendor = Vendor::create(['name' => 'AdNetwork', 'role' => VendorRole::ThirdParty]);

    expect($vendor->issues())->toBe([])
        ->and(VendorRole::ThirdParty->checklist())->toBe([]);

    $vendor->update(['dpa_signed_at' => now(), 'dpa_expires_at' => now()->addMonth()]);
    $this->travel(2)->months();

    expect($vendor->issues())->toBe([VendorIssue::AgreementExpired]);
});

it('asks for a review by risk tier', function () {
    $high = Vendor::create(['name' => 'Payroll', 'role' => VendorRole::Processor, 'risk' => VendorRisk::High, 'dpa_signed_at' => now(), 'dpa_checklist' => fullChecklist(VendorRole::Processor)]);

    $this->travel(13)->months();

    expect($high->issues())->toBe([VendorIssue::ReviewDue])
        ->and($high->markReviewed()->issues())->toBe([]);
});

it('owes the data deletion or return after termination', function () {
    $vendor = Vendor::create(['name' => 'Old CRM', 'role' => VendorRole::Processor])->terminate();

    expect($vendor->issues())->toBe([VendorIssue::DataReturnPending])
        ->and(Vendor::query()->scopes('active')->count())->toBe(0)
        ->and($vendor->confirmDataReturned()->issues())->toBe([]);
});

it('lists vendors and their issues', function () {
    Vendor::create(['name' => 'Stripe', 'role' => VendorRole::Processor]);

    Artisan::call('us-privacy:vendors');
    expect(Artisan::output())->toContain('Stripe')->toContain('No signed contract')->toContain('1 vendor(s) with issues.');

    Artisan::call('us-privacy:vendors', ['--json' => true, '--issues' => true]);
    expect(json_decode(Artisan::output(), true))->toHaveCount(1)
        ->{0}->issues->toBe(['agreement_missing']);
});
