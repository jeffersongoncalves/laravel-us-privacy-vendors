<?php

return [

    'table' => 'us_privacy_vendors',

    /*
     * Terms the written contract must contain. Keys are stored on each vendor's dpa_checklist;
     * a vendor with an unchecked item of its role is flagged.
     */
    'checklist' => [
        // Controller-processor contract, required by every state (e.g. Va. Code §59.1-579(B)).
        'processor' => [
            'instructions' => 'Sets out the instructions for processing the data',
            'nature_and_purpose' => 'Describes the nature and purpose of the processing',
            'data_types' => 'Lists the types of personal data processed',
            'duration' => 'States the duration of the processing',
            'rights_and_obligations' => 'States the rights and obligations of both parties',
            'confidentiality' => 'Binds every person processing the data to a duty of confidentiality',
            'delete_or_return' => 'Requires deleting or returning the data at the end of the services, unless the law requires keeping it',
            'compliance_information' => 'Makes available the information needed to demonstrate compliance',
            'assessments' => 'Allows and cooperates with reasonable assessments or audits, or provides an independent audit report',
            'subcontractors' => 'Binds subcontractors to the same obligations by written contract, after notice and an opportunity to object',
        ],
        // No statutory contract terms for third parties; track what you agreed.
        'third_party' => [],
    ],

    /*
     * How often each risk tier must be reviewed, counted from the last review
     * (or from registration). CarbonInterval strings.
     */
    'review_every' => [
        'low' => '3 years',
        'medium' => '2 years',
        'high' => '1 year',
    ],

];
