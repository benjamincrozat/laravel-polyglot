<?php

use Illuminate\Support\Facades\Route;

class DomainsDriverTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        app()->bind(
            \BC\Laravel\Polyglot\Drivers\DriverContract::class,
            \BC\Laravel\Polyglot\Drivers\DomainsDriver::class
        );

        Route::get('/', function () {
            //
        });
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('polyglot.driver', 'domains');
        $app['config']->set('polyglot.languages', ['en', 'fr']);
        $app['config']->set('polyglot.domains', [
            'en' => 'example.us',
            'fr' => 'example.fr',
        ]);
    }
}
