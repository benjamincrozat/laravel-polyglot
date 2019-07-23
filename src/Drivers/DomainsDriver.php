<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Http\Request;

class DomainsDriver extends BaseDriver implements DriverContract
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Request $request
     */
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
        foreach (config('polyglot.domains') as $language => $domain) {
            if ($this->request->getHost() === $domain && in_array($language, config('polyglot.languages'))) {
                app()->setLocale($language);

                break;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function switchTo($language)
    {
        return str_replace($this->request->getHost(), config("polyglot.domains.$language"), $this->request->fullUrl());
    }
}
