<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
    public function prefix() : string
    {
        return $this->request->segments()[0];
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale() : void
    {
        $language_directory = $this->prefix();
        $valid_languages    = array_keys(config('polyglot.languages', ['en']));

        if (! in_array($language_directory, $valid_languages)) {
            throw new \Exception;
        }

        app()->setLocale($language_directory);
        Carbon::setLocale(app()->getLocale());
        Carbon::setUtf8(true);
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * This method registers the "/" route. Because this driver is based
     * on directories, users should never be able to display "/".
     */
    protected function secureRootRoute() : void
    {
        Route::get('/', function () {
            return redirect($this->switchTo(config('app.locale')));
        });
    }
}
