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
        $host    = request()->getHost();
        $port    = ! str_contains($_SERVER['HTTP_HOST'], ':') ?: ':' . request()->getPort();
        $current = $this->current() ? '/' . $this->current() : '';

        return str_replace(
            $host . ($port ?? '') . $current,
            $host . ($port ?? '') . '/' . $to,
            URL::full()
        );
    }

    protected function current()
    {
        return request()->segments()[0] ?? null;
    }
}
