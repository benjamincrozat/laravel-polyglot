<?php

namespace BC\Laravel\Polyglot;

use Illuminate\Support\ServiceProvider;
use BC\Laravel\Polyglot\Drivers\DomainsDriver;
use BC\Laravel\Polyglot\Drivers\DriverContract;
use BC\Laravel\Polyglot\Drivers\DirectoriesDriver;

class PolyglotServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/polyglot.php' => config_path('polyglot.php'),
        ], 'config');

        app(DriverContract::class)->setLocale();
    }

    public function register()
    {
        'domains' === app('config')->get('polyglot.driver')
            ? app()->bind(DriverContract::class, DomainsDriver::class)
            : app()->bind(DriverContract::class, DirectoriesDriver::class);

        app()->bind('polyglot', Polyglot::class);
    }
}
