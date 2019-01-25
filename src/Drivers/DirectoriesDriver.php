<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Support\Facades\Route;
use BC\Laravel\Polyglot\Presenters\PresenterContract;

class DirectoriesDriver extends BaseDriver implements DriverContract
{
    public function __construct(PresenterContract $presenter)
    {
        parent::__construct($presenter);

        $this->routes();
    }

    public function prefix() : string
    {
        return app()->getLocale();
    }

    public function setLocale() : void
    {
        if (in_array($this->current(), config('polyglot.languages') ?? [])) {
            app()->setLocale($this->current());
        }
    }

    protected function routes()
    {
        Route::get('/', function () {
            return redirect(
                $this->presenter()->switchTo(app()->getLocale())
            );
        });
    }

    protected function current()
    {
        return request()->segments()[0] ?? null;
    }
}
