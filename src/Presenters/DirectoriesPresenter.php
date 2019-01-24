<?php

namespace BC\Laravel\Polyglot\Presenters;

class DirectoriesPresenter implements PresenterContract
{
    public function routeTo(string $to, $arguments) : string
    {
    }

    public function switchTo(string $to) : string
    {
        return str_replace(
            $this->request->getHost() . (! $this->current() ?: '/' . $this->current()),
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
