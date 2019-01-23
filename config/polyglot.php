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
    | Supported: "directories", "domains"
    |
    */
    'driver' => 'directories',

    /*
    |--------------------------------------------------------------------------
    | Supported Languages
    |--------------------------------------------------------------------------
    |
    | This parameter is useful when using the `directories` driver, since
    | it prevents users to display unsupported or imcomplete languages.
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
