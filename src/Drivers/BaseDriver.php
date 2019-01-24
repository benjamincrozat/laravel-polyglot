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

    public function prefix() : string
    {
        return '';
    }

    public function presenter() : PresenterContract
    {
        return $this->presenter;
    }
}
