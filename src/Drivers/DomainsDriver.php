<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use BC\Laravel\Polyglot\Presenters\PresenterContract;

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

    public function __construct(Application $app, Request $request, PresenterContract $presenter)
    {
        parent::__construct($presenter);

        $this->app        = $app;
        $this->request    = $request;
    }

    public function prefix() : string
    {
        return '';
    }

    public function setLocale() : void
    {
        foreach ($this->app['config']->get('polyglot.domains') as $language => $domain) {
            if ($this->request->getHost() === $domain && in_array($language, $this->app['config']->get('polyglot.languages'))) {
                $this->app->setLocale($language);

                break;
            }
        }
    }
}
