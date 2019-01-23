<?php

namespace BC\Laravel\Polyglot;

use BC\Laravel\Polyglot\Drivers\DriverContract;

class Polyglot
{
    /**
     * @var DriverContract
     */
    protected $driver;

    public function __construct(DriverContract $driver)
    {
        $this->driver = $driver;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->driver, $name)) {
            return $this->driver->{$name}(...$arguments);
        }
    }

    public function driver()
    {
        return $this->driver;
    }
}
