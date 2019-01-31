<?php

namespace BC\Laravel\Polyglot\Drivers;

use BC\Laravel\Polyglot\Presenters\PresenterContract;

interface DriverContract
{
    public function prefix() : string;

    public function setLocale();

    public function presenter() : PresenterContract;
}
