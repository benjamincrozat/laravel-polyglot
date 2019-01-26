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
        $port    = request()->getPort();
        $current = $this->current();

        return str_replace(
            request()->getHost() . ($port ? ':' . $port : '') . ($current ? '/' . $current : ''),
            request()->getHost() . ($port ? ':' . $port : '') . '/' . $to,
            URL::full()
        );
    }

    protected function current()
    {
        return request()->segments()[0] ?? null;
    }
}
