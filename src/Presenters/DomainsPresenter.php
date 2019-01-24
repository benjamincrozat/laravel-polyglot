<?php

namespace BC\Laravel\Polyglot\Presenters;

use Illuminate\Support\Facades\URL;

class DomainsPresenter implements PresenterContract
{
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
}
