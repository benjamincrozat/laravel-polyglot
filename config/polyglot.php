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
    | Supported:
    | - query_string: https://foo.com?language={language}
    | - directories: https://foo.com/{language}
    | - domains: https://{language}.foo.com or https://foo.com and https://bar.com
    |
    */
    'driver' => env('POLYGLOT_DRIVER', 'query_string'),

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
    | This list of languages prevents users to display unsupported languages.
    |
    */
    'languages' => [
        'en' => 'English',
    ],

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
