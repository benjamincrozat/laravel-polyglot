<?php

namespace BC\Laravel\Polyglot\Presenters;

use Illuminate\Support\Facades\URL;

class DirectoriesPresenter implements PresenterContract
{
    /**
     * {@inheritDoc}
     */
    public function routeTo(string $to, $arguments) : string
    {
    }

    /**
     * {@inheritDoc}
     */
    public function switchTo(string $to) : string
    {
        return str_replace(
            request()->getHost() . ($this->current() ? '/' . $this->current() : ''),
            request()->getHost() . '/' . $to,
            URL::full()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function urlTo(string $to, $arguments) : string
    {
    }

    protected function current()
    {
        return request()->segments()[0] ?? null;
    }
}
