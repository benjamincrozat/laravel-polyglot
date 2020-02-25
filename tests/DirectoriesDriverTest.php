<?php

use Illuminate\Support\Facades\Route;
use BC\Laravel\Polyglot\Middlewares\Localized;

class DirectoriesDriverTest extends TestCase
{
    /** @test */
    public function it_needs_routes_provider_to_be_modified_for_prefixes() : void
    {
        foreach (config('polyglot.languages') as $key => $value) {
            Route::prefix($key)
                 ->group(function () {
                     Route::get('/foo', fn () => '');
                     Route::get('/bar', fn () => '');
                 });
        }

        $this->getJson('/en/foo')->assertOk();
        $this->getJson('/en/bar')->assertOk();
        $this->getJson('/fr/foo')->assertOk();
        $this->getJson('/fr/bar')->assertOk();
    }

    /** @test */
    public function it_changes_laravel_locale_on_routes_with_middleware() : void
    {
        foreach (config('polyglot.languages') as $key => $value) {
            Route::prefix($key)
                 ->group(function () {
                     Route::middleware(Localized::class)->get('/foo', fn () => app()->getLocale());
                 });
        }

        $this->assertEquals('fr', $this->getJson('/fr/foo')->getContent());
    }

    /** @test */
    public function it_does_not_change_laravel_locale_on_routes_without_middleware() : void
    {
        foreach (config('polyglot.languages') as $key => $value) {
            Route::prefix($key)
                 ->group(function () {
                     Route::get('/foo', fn () => app()->getLocale());
                 });
        }

        $this->assertEquals('en', $this->getJson('/fr/foo')->getContent());
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('polyglot', require __DIR__ . '/../config/polyglot.php');
        $app['config']->set('polyglot.languages', [
            'en' => 'English',
            'fr' => 'Français',
        ]);
    }
}
