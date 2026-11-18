# Changelog

All notable changes to this project will be documented in this file.

## 1.0.0 - 2026-11-17

First release of laravel-us-privacy-vendors, a register of the processors and third parties you disclose personal data to under the US state privacy laws.

- Processors: the controller-processor contract terms every state requires (instructions, nature and purpose, data types, duration, rights and obligations, confidentiality, deletion or return, compliance information, assessments, subcontractors), tracked per vendor.
- Third parties: no statutory contract terms; list them in your privacy notice.
- Reviews by risk (low 3 years, medium 2, high 1), termination and confirmation of data deletion or return.
- `php artisan us-privacy:vendors [--issues] [--json]`.

## [Unreleased]
