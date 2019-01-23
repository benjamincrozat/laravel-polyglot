<?php

namespace BC\Laravel\Settings\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string urlToLanguage(string $language)
 * @method static string prefix()
 * @method static void setLocale()
 */
class Polyglot extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'polyglot';
    }
}
