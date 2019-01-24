<?php

namespace BC\Laravel\Polyglot\Presenters;

use Illuminate\Support\Facades\URL;

class DomainsPresenter implements PresenterContract
{
    public function routeTo(string $to, $arguments) : string
    {
    }

    /**
     * {@inheritdoc}
     */
    public function switchTo(string $to) : string
    {
        return str_replace(
            request()->getHost(),
            config('polyglot.domains')[$to],
            URL::full()
        );
    }

    public function urlTo(string $to, $arguments) : string
    {
    }
}
