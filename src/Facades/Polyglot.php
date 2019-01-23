<?php

namespace BC\Laravel\Settings\Facades;

use Illuminate\Support\Facades\Facade;

class Polyglot extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'polyglot';
    }
}
