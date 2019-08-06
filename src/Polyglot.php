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

    /**
     * Redirect calls to the driver since this class acts as a proxy.
     *
     * @param mixed $name
     * @param mixed $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this->driver(), $name)) {
            return $this->driver()->{$name}(...$arguments);
        }
    }

    public function driver() : DriverContract
    {
        return $this->driver;
    }
}
