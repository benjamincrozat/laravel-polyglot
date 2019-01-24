<?php

namespace BC\Laravel\Polyglot\Presenters;

interface PresenterContract
{
    /**
     * Switch the current URL to the desired language.
     *
     * @param string $to
     *
     * @return string
     */
    public function switchTo(string $to) : string;
}
