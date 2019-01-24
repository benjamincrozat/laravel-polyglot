<?php

namespace BC\Laravel\Polyglot\Presenters;

interface PresenterContract
{
    public function routeTo(string $to, $arguments) : string;

    /**
     * Switch the current URL to the desired language.
     *
     * @param string $to
     *
     * @return string
     */
    public function switchTo(string $to) : string;

    public function urlTo(string $to, $arguments) : string;
}
