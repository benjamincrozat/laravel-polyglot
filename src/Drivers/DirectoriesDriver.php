<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Foundation\Application;
use BC\Laravel\Polyglot\Presenters\PresenterContract;

class DirectoriesDriver extends BaseDriver implements DriverContract
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

    public function __construct(Application $app, Router $router, Redirector $redirector, Request $request, UrlGenerator $url, PresenterContract $presenter)
    {
        parent::__construct($presenter);

        $this->app        = $app;
        $this->router     = $router;
        $this->redirector = $redirector;
        $this->request    = $request;
        $this->url        = $url;

        $this->routes();
    }

    public function prefix() : string
    {
        return $this->app->getLocale();
    }

    public function setLocale() : void
    {
        if ($this->isCurrentValid()) {
            $this->app->setLocale($this->current());
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

    protected function isCurrentValid()
    {
        return in_array($this->current(), $this->languages());
    }

    protected function current()
    {
        return $this->request->segments()[0] ?? null;
    }

    protected function languages()
    {
        return $this->app['config']->get('polyglot.languages');
    }
}
