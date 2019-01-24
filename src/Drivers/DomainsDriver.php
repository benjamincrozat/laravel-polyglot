<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use BC\Laravel\Polyglot\Presenters\PresenterContract;

class DomainsDriver extends BaseDriver implements DriverContract
{
    public function __construct(PresenterContract $presenter)
    {
        parent::__construct($presenter);
    }

    public function setLocale() : void
    {
        foreach (config('polyglot.domains') as $language => $domain) {
            if (request()->getHost() === $domain && in_array($language, config('polyglot.languages'))) {
                app()->setLocale($language);

                break;
            }
        }
    }
}
