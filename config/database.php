<?php

return [
    'default' => env('DB_CONNECTION', 'pgsql'),

    'connections' => [

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'pais-template-new'),
            'username' => env('DB_USERNAME', 'postgres'),
            'password' => env('DB_PASSWORD', 'Jonson123'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'pamis' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('PAMIS_DB_HOST', '127.0.0.1'),
            'port' => env('PAMIS_DB_PORT', '5432'),
            'database' => env('PAMIS_DB_DATABASE', 'pamis'),
            'username' => env('PAMIS_DB_USERNAME', 'postgres'),
            'password' => env('PAMIS_DB_PASSWORD', 'Jonson123'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'mpis' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('MPIS_HOST', '10.50.6.111'),
            'port' => env('MPIS_PORT', '5432'),
            'database' => env('MPIS_DATABASE', 'mpis'),
            'username' => env('MPIS_USERNAME', 'postgres'),
            'password' => env('MPIS_PASSWORD', '(P@m!sv3_#DB_*2021/)'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],
    ],

    'migrations' => 'migrations'
];