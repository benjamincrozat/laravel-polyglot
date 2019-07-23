<?php

namespace BC\Laravel\Polyglot;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use BC\Laravel\Polyglot\Drivers\DomainsDriver;
use BC\Laravel\Polyglot\Drivers\DriverContract;
use BC\Laravel\Polyglot\Drivers\DirectoriesDriver;
use BC\Laravel\Polyglot\Drivers\QueryStringDriver;

class PolyglotServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/polyglot.php' => config_path('polyglot.php'),
        ], 'polyglot-config');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'polyglot');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/polyglot'),
        ], 'polyglot-views');

        polyglot()->setLocale();
        Carbon::setLocale(app()->getLocale());
        Carbon::setUtf8(true);
    }

    public function register()
    {
        if ('domains' === app('config')->get('polyglot.driver')) {
            app()->bind(DriverContract::class, DomainsDriver::class);
        } elseif ('directories' === app('config')->get('polyglot.driver')) {
            app()->bind(DriverContract::class, DirectoriesDriver::class);
        } else {
            app()->bind(DriverContract::class, QueryStringDriver::class);
        }

        app()->bind('polyglot', Polyglot::class);
    }
}
