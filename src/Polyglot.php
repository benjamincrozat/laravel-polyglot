<?php

namespace BC\Laravel\Polyglot;

use BC\Laravel\Polyglot\Drivers\DriverContract;

/**
 * @method static string prefix()
 * @method static setLocale()
 * @method static Presenters\PresenterContract presenter()
 * @method static string switchTo(string $language)
 */
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
        if (method_exists($this->driver(), $name)) {
            return $this->driver()->{$name}(...$arguments);
        }

        if (method_exists($this->driver()->presenter(), $name)) {
            return $this->driver()->presenter()->{$name}(...$arguments);
        }
    }

    public function driver()
    {
        return $this->driver;
    }
}
