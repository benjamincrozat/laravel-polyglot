<?php

namespace BC\Laravel\Settings\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string prefix()
 * @method static void setLocale()
 * @method static \BC\Laravel\Polyglot\Presenters\PresenterContract presenter()
 * @method static string switchTo(string $language)
 */
class Polyglot extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'polyglot';
    }
}
