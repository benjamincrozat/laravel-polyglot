<?php

namespace BC\Laravel\Polyglot\Presenters;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Foundation\Application;

class DomainsPresenter implements PresenterContract
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var UrlGenerator
     */
    protected $url;

    public function __construct(Application $app, Request $request, UrlGenerator $url)
    {
        $this->app        = $app;
        $this->request    = $request;
        $this->url        = $url;
    }

    public function routeTo(string $to, $arguments) : string
    {
    }

    public function switchTo(string $to) : string
    {
        return str_replace(
            $this->request->getHost(),
            $this->app['config']->get('polyglot.domains')[$to],
            $this->url->full()
        );
    }

    public function urlTo(string $to, $arguments) : string
    {
    }
}
