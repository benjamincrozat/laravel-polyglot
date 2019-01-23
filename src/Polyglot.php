<?php

namespace BC\Laravel\Polyglot;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Foundation\Application;

class Polyglot
{
    /**
     * @var Application
     */
    protected $app;

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

    public function __construct(Application $app, Redirector $redirector, Request $request, UrlGenerator $url)
    {
        $this->app        = $app;
        $this->redirector = $redirector;
        $this->request    = $request;
        $this->url        = $url;
    }

    /**
     * Get the current URL and switch the language.
     *
     * @param string $language
     *
     * @return string
     */
    public function urlTo($language)
    {
        $host            = $this->request->getHost();
        $guessedLanguage = $this->guessedLanguage() ? '/' . $this->guessedLanguage() : null;

        if ('domains' === config('polyglot.strategy')) {
            return str_replace(
                $host,
                config('polyglot.domains')[$language],
                $this->url->full()
            );
        }

        return str_replace(
            $host . $guessedLanguage,
            $host . '/' . $language,
            $this->url->full()
        );
    }

    /**
     * Get routes prefix if current strategy requires it.
     *
     * @return string
     */
    public function prefix()
    {
        return $this->isDirectoriesStrategy() ? $this->app->getLocale() : '';
    }

    public function setLocaleFromDomain()
    {
        foreach (config('polyglot.domains') as $key => $value) {
            if ($this->request->getHost() === $value && in_array($key, config('polyglot.languages'))) {
                $this->app->setLocale($key);

                break;
            }
        }
    }

    public function setLocaleFromDirectory()
    {
        if ($this->isGuessedLanguageValid()) {
            $this->app->setLocale($this->guessedLanguage());
        }
    }

    public function registerRootRoute()
    {
        Route::get('/', function () {
            return $this->redirector->to(
                $this->urlTo($this->app->getLocale())
            );
        });
    }

    public function isDomainsStrategy()
    {
        return 'domains' === config('polyglot.strategy');
    }

    public function isDirectoriesStrategy()
    {
        return 'directories' === config('polyglot.strategy');
    }

    public function isGuessedLanguageValid()
    {
        return in_array($this->guessedLanguage(), $this->languages());
    }

    public function guessedLanguage()
    {
        return $this->request->segments()[0] ?? null;
    }

    public function languages()
    {
        return $this->app['config']->get('polyglot.languages');
    }
}
