<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Foundation\Application;

class DomainsDriver extends BaseDriver implements DriverContract
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

    public function __construct(Application $app, Request $request, UrlGenerator $url, PresenterContract $presenter)
    {
        parent::__construct($presenter);

        $this->app        = $app;
        $this->request    = $request;
        $this->url        = $url;
    }

    public function prefix() : string
    {
        return '';
    }

    public function setLocale() : void
    {
        foreach ($this->domains() as $language => $domain) {
            if ($this->request->getHost() === $domain && in_array($language, $this->languages())) {
                $this->app->setLocale($language);

                break;
            }
        }
    }

    protected function domains()
    {
        return $this->app['config']->get('polyglot.domains');
    }

    protected function languages()
    {
        return $this->app['config']->get('polyglot.languages');
    }
}
