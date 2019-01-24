<?php

namespace BC\Laravel\Polyglot\Presenters;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\UrlGenerator;

class DirectoriesPresenter implements PresenterContract
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var UrlGenerator
     */
    protected $url;

    public function __construct(Request $request, UrlGenerator $url)
    {
        $this->request    = $request;
        $this->url        = $url;
    }

    public function routeTo(string $to, $arguments) : string
    {
    }

    public function switchTo(string $to) : string
    {
        return str_replace(
            $this->request->getHost() . ($this->current() ? '/' . $this->current() : ''),
            $this->request->getHost() . '/' . $to,
            $this->url->full()
        );
    }

    public function urlTo(string $to, $arguments) : string
    {
    }

    protected function current()
    {
        return $this->request->segments()[0] ?? null;
    }
}
