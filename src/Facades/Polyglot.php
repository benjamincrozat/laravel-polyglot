<?php

namespace BC\Laravel\Polyglot\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string prefix()
 * @method static void setLocale()
 * @method static string switchTo(string $language)
 * @method static \BC\Laravel\Polyglot\Drivers\DirectoriesDriver driver()
 */
class Polyglot extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'polyglot';
    }
}
