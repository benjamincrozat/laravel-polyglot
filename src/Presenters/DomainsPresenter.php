<?php

namespace BC\Laravel\Polyglot\Presenters;

class DomainsPresenter implements PresenterContract
{
    public function routeTo(string $to, $arguments) : string
    {
    }

    public function switchTo(string $to) : string
    {
        return str_replace(
            $this->request->getHost(),
            $this->domainForLanguage($language),
            $this->url->full()
        );
    }

    public function urlTo(string $to, $arguments) : string
    {
    }

    protected function domainForLanguage($language)
    {
        return $this->domains()[$language];
    }

    protected function current()
    {
        return $this->request->segments()[0] ?? null;
    }
}
