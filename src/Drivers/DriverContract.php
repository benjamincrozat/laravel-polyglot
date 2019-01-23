<?php

namespace BC\Laravel\Polyglot\Drivers;

interface DriverContract
{
    public function switch(string $language) : string;

    public function prefix() : string;

    public function setLocale() : void;
}
