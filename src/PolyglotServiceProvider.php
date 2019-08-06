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

        polyglot()->setLocale();
        Carbon::setLocale(app()->getLocale());
        Carbon::setUtf8(true);
    }

    public function register() : void
    {
        switch (config('polyglot.driver')) {
            case 'domains':
                app()->bind(DriverContract::class, DomainsDriver::class);
                break;

            case 'directories':
                app()->bind(DriverContract::class, DirectoriesDriver::class);
                break;

            default:
                app()->bind(DriverContract::class, QueryStringDriver::class);
        }

        app()->bind('polyglot', Polyglot::class);
    }
}
