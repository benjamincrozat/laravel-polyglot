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
    public function boot() : void
    {
        $this->publishes([
            __DIR__ . '/../config/polyglot.php' => config_path('polyglot.php'),
        ], 'polyglot-config');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'polyglot');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/polyglot'),
        ], 'polyglot-views');

        $this->app['polyglot']->setLocale();
        Carbon::setLocale($this->app->getLocale());
        Carbon::setUtf8(true);
    }

    public function register() : void
    {
        switch (config('polyglot.driver')) {
            case 'domains':
                $this->app->bind(DriverContract::class, DomainsDriver::class);
                break;

            case 'directories':
                $this->app->bind(DriverContract::class, DirectoriesDriver::class);
                break;

            default:
                $this->app->bind(DriverContract::class, QueryStringDriver::class);
        }

        $this->app->bind('polyglot', Polyglot::class);
    }
}
