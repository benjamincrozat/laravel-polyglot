<?php

namespace BC\Laravel\Polyglot;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use BC\Laravel\Polyglot\Drivers\DirectoriesDriver;

class Polyglot
{
    public DirectoriesDriver $driver;

    public Request $request;

    public function __construct(DirectoriesDriver $driver, Request $request)
    {
        $this->driver  = $driver;
        $this->request = $request;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->driver(), $name)) {
            return $this->driver()->{$name}(...$arguments);
        }
    }

    public function route($name, $parameters = [], $absolute = true) : string
    {
        return app('url')->route(app()->getLocale() . ".$name", $parameters, $absolute);
    }

    public function routeIs(...$patterns) : string
    {
        $patterns[0] = app()->getLocale() . '.' . $patterns[0];

        return Route::is($patterns);
    }

    public function switchTo(string $language) : string
    {
        if ($directory = $this->request->segments()[0] ?? '') {
            return preg_replace("/\/$directory/", "/$language", $this->request->fullUrl());
        }

        if ($this->request->getQueryString()) {
            return "/$language{$this->request->path()}?{$this->request->getQueryString()}";
        }

        return "/$language{$this->request->path()}";
    }

    public function driver() : DirectoriesDriver
    {
        return $this->driver;
    }
}
