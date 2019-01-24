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
     * {@inheritdoc}
     */
    public function prefix() : string
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function presenter() : PresenterContract
    {
        return $this->presenter;
    }
}
