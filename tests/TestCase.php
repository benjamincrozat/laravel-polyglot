<?php

abstract class TestCase extends Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            BC\Laravel\Polyglot\PolyglotServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('polyglot.strategy', 'directories');
        $app['config']->set('polyglot.languages', ['en', 'fr']);
    }
}
