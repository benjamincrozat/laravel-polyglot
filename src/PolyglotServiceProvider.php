<?php

namespace BC\Laravel\Polyglot;

use Illuminate\Support\ServiceProvider;
use BC\Laravel\Polyglot\Drivers\DomainsDriver;
use BC\Laravel\Polyglot\Drivers\DriverContract;
use BC\Laravel\Polyglot\Drivers\DirectoriesDriver;
use BC\Laravel\Polyglot\Presenters\DomainsPresenter;
use BC\Laravel\Polyglot\Presenters\PresenterContract;
use BC\Laravel\Polyglot\Presenters\DirectoriesPresenter;

class PolyglotServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/polyglot.php' => config_path('polyglot.php'),
        ], 'config');

        polyglot()->setLocale();
    }

    public function register()
    {
        if ('domains' === app('config')->get('polyglot.driver')) {
            app()->bind(DriverContract::class, DomainsDriver::class);
            app()->bind(PresenterContract::class, DomainsPresenter::class);
        } else {
            app()->bind(DriverContract::class, DirectoriesDriver::class);
            app()->bind(PresenterContract::class, DirectoriesPresenter::class);
        }

        app()->bind('polyglot', Polyglot::class);
    }
}
