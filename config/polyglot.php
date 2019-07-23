<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Polyglot Driver
    |--------------------------------------------------------------------------
    |
    | The technique used to differenciate and switch languages is
    | defined by a driver. Choose the one that fits your needs.
    |
    | Supported: "query_string", directories", "domains"
    |
    */
    'driver' => 'directories',

    /*
    |--------------------------------------------------------------------------
    | Supported Languages
    |--------------------------------------------------------------------------
    |
    | This parameter prevents users to display unsupported languages.
    |
    */
    'languages' => ['en'],

    /*
    |--------------------------------------------------------------------------
    | Supported Languages
    |--------------------------------------------------------------------------
    |
    | When using the `domains` driver, this is where you associate
    | a language to a domain. It can be a full or a sub domain.
    |
    */
    'domains' => [
        'en' => env('POLYGLOT_EN_DOMAIN'),
    ],
];
