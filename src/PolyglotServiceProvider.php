<?php

namespace BC\Laravel\Polyglot;

use Illuminate\Support\ServiceProvider;

class PolyglotServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/polyglot.php' => config_path('polyglot.php'),
        ], 'config');

        if (polyglot()->isDomainsStrategy()) {
            polyglot()->setLocaleFromDomain();
        } else {
            polyglot()->setLocaleFromDirectory();
            polyglot()->registerRootRoute();
        }
    }

    public function register()
    {
        app()->bind('polyglot', Polyglot::class);
    }
}
