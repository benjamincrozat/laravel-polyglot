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
        $language_directory = $this->request->segments()[0];
        $valid_languages    = config('polyglot.languages');

        if (in_array($language_directory, $valid_languages)) {
            app()->setLocale($language_directory);
        }
    }

    /**
     * This method registers the "/" route. Because this driver is based
     * on directories, users should never be able to display "/".
     */
    protected function secureRootRoute()
    {
        Route::redirect('/', $this->request->fullUrlWithQuery([
            'language' => app()->getLocale(),
        ]));
    }
}
