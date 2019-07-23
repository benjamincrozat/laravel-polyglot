<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DirectoriesDriver implements DriverContract
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->secureRootRoute();
    }

    /**
     * {@inheritdoc}
     */
    public function prefix()
    {
        return app()->getLocale();
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale()
    {
        $language_directory = $this->request->segments()[0] ?? null;
        $valid_languages    = array_keys(config('polyglot.languages'));

        if (in_array($language_directory, $valid_languages)) {
            app()->setLocale($language_directory);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function switchTo($language)
    {
        if ($directory = $this->request->segments()[0] ?? '') {
            return preg_replace("/\/$directory/", "/$language", $this->request->fullUrl());
        }

        if ($this->request->getQueryString()) {
            return "/$language{$this->request->path()}?{$this->request->getQueryString()}";
        }

        return "/$language{$this->request->path()}";
    }

    /**
     * This method registers the "/" route. Because this driver is based
     * on directories, users should never be able to display "/".
     */
    protected function secureRootRoute()
    {
        Route::get('/', function () {
            return redirect($this->switchTo(config('app.locale')));
        });
    }
}
