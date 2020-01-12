<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DomainsDriver implements DriverContract
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
    public function prefix() : ?string
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale() : void
    {
        foreach (config('polyglot.domains') ?? [] as $language => $domain) {
            if ($this->request->getHost() === $domain && in_array($language, array_keys(config('polyglot.languages', ['en'])))) {
                Str::contains(config('app.url'), 'https')
                    ? config(['app.url' => "https://$domain"])
                    : config(['app.url' => "http://$domain"]);

                app()->setLocale($language);

                Carbon::setLocale(app()->getLocale());
                Carbon::setUtf8(true);

                break;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function switchTo(string $language) : string
    {
        return str_replace($this->request->getHost(), config("polyglot.domains.$language"), $this->request->fullUrl());
    }
}
