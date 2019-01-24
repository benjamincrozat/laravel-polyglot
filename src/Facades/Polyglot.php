<?php

namespace BC\Laravel\Polyglot\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string prefix()
 * @method static setLocale()
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
