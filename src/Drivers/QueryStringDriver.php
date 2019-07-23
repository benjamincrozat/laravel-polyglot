<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Http\Request;

class QueryStringDriver implements DriverContract
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function prefix()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale()
    {
        app()->setLocale($this->request->language ?? config('app.locale'));
    }

    /**
     * {@inheritdoc}
     */
    public function switchTo($language)
    {
        return $this->request->fullUrlWithQuery(compact('language'));
    }
}
