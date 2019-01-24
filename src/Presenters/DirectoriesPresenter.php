<?php

namespace BC\Laravel\Polyglot\Presenters;

use Illuminate\Support\Facades\URL;

class DirectoriesPresenter implements PresenterContract
{
    /**
     * {@inheritdoc}
     */
    public function switchTo(string $to) : string
    {
        return str_replace(
            request()->getHost() . ($this->current() ? '/' . $this->current() : ''),
            request()->getHost() . '/' . $to,
            URL::full()
        );
    }

    protected function current()
    {
        return request()->segments()[0] ?? null;
    }
}
