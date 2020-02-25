<?php

use BC\Laravel\Polyglot\Facades\Polyglot;
use BC\Laravel\Polyglot\PolyglotServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            PolyglotServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Polyglot' => Polyglot::class,
        ];
    }
}
