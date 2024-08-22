<?php

return [
    'base_uri' => env('MS_VENDAS_BASE_URI', 'https://api-dev-vendas.nave.dev'),

    'front_uri' => env('MS_VENDAS_FRONT_URI', 'https://develop.vendas.nave.dev'),

    'prefix' => env('MS_VENDAS_API_PREFIX', '/api'),

    'db' => [
        'url' => env('MS_VENDAS_DB_URL'),
        'host' => env('MS_VENDAS_DB_HOST'),
        'port' => env('MS_VENDAS_DB_PORT'),
        'database' => env('MS_VENDAS_DB_DATABASE'),
        'username' => env('MS_VENDAS_DB_USERNAME'),
        'password' => env('MS_VENDAS_DB_PASSWORD'),
    ],
];
