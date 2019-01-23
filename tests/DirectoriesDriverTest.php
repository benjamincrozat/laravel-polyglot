<?php

use Illuminate\Support\Facades\Route;

class DirectoriesDriverTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Route::prefix(polyglot()->prefix())
            ->group(function () {
                Route::get('/login', function () {
                    //
                });
            });
    }

    /** @test */
    public function it_redirects_when_language_is_not_set()
    {
        $this->get('/')
            ->assertRedirect('/en');
    }

    /** @test */
    public function it_throws_a_404_when_language_is_wrong()
    {
        $this->get('/it')
            ->assertStatus(404);
    }

    /** @test */
    public function it_works()
    {
        $this->get('/en/login')
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_switch_languages()
    {
        $this->get('/en/login')
            ->assertStatus(200);

        $this->assertEquals(config('app.url') . '/fr/login', polyglot()->urlToLanguage('fr'));
    }

    /** @test */
    public function it_still_serves_non_prefixed_routes()
    {
        Route::get('/foo', function () {
            //
        });

        $this->get('/foo')
            ->assertStatus(200);
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('polyglot.driver', 'directories');
        $app['config']->set('polyglot.languages', ['en', 'fr']);
    }
}
