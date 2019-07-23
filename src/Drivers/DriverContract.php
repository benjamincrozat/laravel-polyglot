<?php

namespace BC\Laravel\Polyglot\Drivers;

interface DriverContract
{
    /**
     * @return string
     */
    public function prefix();

    public function setLocale();
}
