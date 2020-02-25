<?php

namespace BC\Laravel\Polyglot;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use BC\Laravel\Polyglot\Drivers\DriverContract;
use BC\Laravel\Polyglot\Controllers\RootController;

class PolyglotServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        if (! $this->app['config']->get('polyglot.redirect_disabled')) {
            $this->registerRoutes();
        }

        $this->publishes([
            __DIR__ . '/../config/polyglot.php' => config_path('polyglot.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'polyglot');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/polyglot'),
        ], 'views');
    }

    public function register() : void
    {
        $this->app->bind(DriverContract::class, config('polyglot.driver'));
        $this->app->bind('polyglot', Polyglot::class);
    }

    protected function registerRoutes() : void
    {
        // We use a controller to not break routes caching.
        Route::get('/', RootController::class);
    }
}
