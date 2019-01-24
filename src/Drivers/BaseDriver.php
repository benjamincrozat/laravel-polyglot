<?php

namespace BC\Laravel\Polyglot\Drivers;

use BC\Laravel\Polyglot\Presenters\PresenterContract;

abstract class BaseDriver implements DriverContract
{
    /**
     * @var PresenterContract
     */
    protected $presenter;

    public function __construct(PresenterContract $presenter)
    {
        $this->presenter = $presenter;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->presenter, $name)) {
            return $this->presenter->{$name}(...$arguments);
        }
    }

    public function presenter() : PresenterContract
    {
        return $this->presenter;
    }
}
