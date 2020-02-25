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
    */
    'driver' => BC\Laravel\Polyglot\Drivers\DirectoriesDriver::class,

    /*
    |--------------------------------------------------------------------------
    | Redirection
    |--------------------------------------------------------------------------
    |
    | Based on their browser language, Laravel Polyglot can redirect visitors to their
    | corresponding language as long as they don't have a cookie that prevents it.
    |
    */
    'redirect_disabled' => env('POLYGLOT_REDIRECT_DISABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Supported Languages
    |--------------------------------------------------------------------------
    |
    | This list helps you generate the lang switcher and
    | prevents users to display unsupported languages.
    |
    */
    'languages' => [
        'en' => 'English',
    ],
];
