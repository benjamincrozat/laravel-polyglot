<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Foundation\Application;

class DirectoriesDriver implements DriverContract
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Redirector
     */
    protected $redirector;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var UrlGenerator
     */
    protected $url;

    public function __construct(Application $app, Router $router, Redirector $redirector, Request $request, UrlGenerator $url)
    {
        $this->app        = $app;
        $this->router     = $router;
        $this->redirector = $redirector;
        $this->request    = $request;
        $this->url        = $url;

        $this->routes();
    }

    public function urlToLanguage(string $target) : string
    {
        $guessed_language = $this->guessedLanguage() ? '/' . $this->guessedLanguage() : '';

        return str_replace(
            $this->request->getHost() . $guessed_language,
            $this->request->getHost() . '/' . $target,
            $this->url->full()
        );
    }

    public function prefix() : string
    {
        return $this->app->getLocale();
    }

    public function setLocale() : void
    {
        if ($this->isGuessedLanguageValid()) {
            $this->app->setLocale($this->guessedLanguage());
        }
    }

    protected function routes()
    {
        $this->router->get('/', function () {
            return $this->redirector->to(
                $this->urlToLanguage($this->app->getLocale())
            );
        });
    }

    protected function isGuessedLanguageValid()
    {
        return in_array($this->guessedLanguage(), $this->languages());
    }

    protected function guessedLanguage()
    {
        return $this->request->segments()[0] ?? null;
    }

    protected function languages()
    {
        return $this->app['config']->get('polyglot.languages');
    }
}
