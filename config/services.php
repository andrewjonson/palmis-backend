<?php

return [
    'mpf' => [
        'base_url' => env('MPF_BASE_URL'),
        'secret' => env('MPF_SECRET')
    ],

    'mpis' => [
        'base_url' => env('MPIS_BASE_URL'),
        'secret' => env('MPIS_SECRET')
    ],

    'orderpub' => [
        'base_url' => env('ORDERPUB_BASE_URL'),
        'secret' => env('ORDERPUB_SECRET')
    ],

    'cmis' => [
        'base_url' => env('CMIS_BASE_URL'),
        'secret' => env('CMIS_SECRET')
    ],

    'toeis' => [
        'base_url' => env('TOEIS_BASE_URL'),
        'secret' => env('TOEIS_SECRET')
    ]
];