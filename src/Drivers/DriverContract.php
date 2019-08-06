<?php

namespace BC\Laravel\Polyglot\Drivers;

interface DriverContract
{
    /**
     * Return a URL prefix if the driver needs one.
     */
    public function prefix() : string;

    /**
     * Set the locale in a way that depends on the chosen driver.
     */
    public function setLocale() : void;

    /**
     * Generate an URL to a given language.
     */
    public function switchTo(string $language) : string;
}
