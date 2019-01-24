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

    /**
     * {@inheritDoc}
     */
    public function prefix() : string
    {
        return '';
    }

    /**
     * {@inheritDoc}
     */
    public function presenter() : PresenterContract
    {
        return $this->presenter;
    }
}
