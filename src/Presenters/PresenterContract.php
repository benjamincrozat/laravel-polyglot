<?php

namespace BC\Laravel\Polyglot\Presenters;

interface PresenterContract
{
    public function routeTo(string $to, $arguments) : string;

    public function switchTo(string $to) : string;

    public function urlTo(string $to, $arguments) : string;
}
