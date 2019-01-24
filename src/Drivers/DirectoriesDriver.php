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

    public function __construct(Application $app, Router $router, Redirector $redirector, Request $request, UrlGenerator $url, PresenterContract $presenter)
    {
        parent::__construct($presenter);

        $this->app        = $app;
        $this->router     = $router;
        $this->redirector = $redirector;
        $this->request    = $request;

        $this->routes();
    }

    public function prefix() : string
    {
        return $this->app->getLocale();
    }

    public function setLocale() : void
    {
        if (in_array($this->current(), $this->app['config']->get('polyglot.languages'))) {
            $this->app->setLocale($this->current());
        }
    }

    protected function routes()
    {
        $this->router->get('/', function () {
            return $this->redirector->to(
                $this->presenter()->switchTo($this->app->getLocale())
            );
        });
    }

    protected function current()
    {
        return $this->request->segments()[0] ?? null;
    }
}
