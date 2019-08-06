<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class QueryStringDriver implements DriverContract
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
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
    public function setLocale() : void
    {
        app()->setLocale(
            $this->preferredLocale()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function switchTo(string $language) : string
    {
        return $this->request->fullUrlWithQuery(compact('language'));
    }

    /**
     * Infer visitor's preferred language based on query
     * string, existing cookie or browser preference.
     */
    protected function preferredLocale() : string
    {
        if ($this->request->language && $this->isValidLanguage($this->request->language)) {
            Cookie::queue('language', $this->request->language, 60 * 24 * 365);

            return $this->request->language;
        }

        if (! empty($this->request->cookie('language')) && $this->isValidLanguage($language = $this->request->cookie('language'))) {
            return $language;
        }

        return explode('_', $this->request->getPreferredLanguage())[0];
    }

    /**
     * Check if a given language is authorized in the config file.
     */
    protected function isValidLanguage(string $language) : bool
    {
        return in_array($language, array_keys(config('polyglot.languages', ['en'])));
    }
}
