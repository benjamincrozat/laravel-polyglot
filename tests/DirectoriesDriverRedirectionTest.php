<?php

use Illuminate\Support\Facades\Route;
use BC\Laravel\Polyglot\Controllers\RootController;

class DirectoriesDriverRedirectionTest extends TestCase
{
    /** @test */
    public function it_redirects_to_preferred_language() : void
    {
        $this->assertNotNull(
            Route::getRoutes()
                ->getByAction(RootController::class)
        );

        $this->getJson('/', ['Accept-Language' => 'fr_FR'])
            ->assertRedirect('/fr');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.locale', 'fr');
        $app['config']->set('polyglot', require __DIR__ . '/../config/polyglot.php');
        $app['config']->set('polyglot.languages', [
            'en' => 'English',
            'fr' => 'Français',
        ]);
    }
}
