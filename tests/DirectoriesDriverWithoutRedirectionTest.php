<?php

use Illuminate\Support\Facades\Route;

class DirectoriesDriverWithoutRedirectionTest extends TestCase
{
    /** @test */
    public function it_allows_redirection_to_preferred_language_to_be_disabled() : void
    {
        $this->getJson('/')->assertStatus(404);

        // Users probably will disable redirect when they want to put
        // a language selection page at the root of their domain.
        Route::get('/', fn () => '');

        $this->getJson('/')->assertOk();
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.locale', 'fr');
        $app['config']->set('polyglot', require __DIR__ . '/../config/polyglot.php');
        $app['config']->set('polyglot.languages', [
            'en' => 'English',
            'fr' => 'Français',
        ]);
        $app['config']->set('polyglot.redirect_disabled', true);
    }
}
