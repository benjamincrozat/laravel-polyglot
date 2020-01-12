<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
    public function prefix() : ?string
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale(?string $locale = null) : void
    {
        app()->setLocale(
            $this->preferredLocale($locale)
        );

        Carbon::setLocale(app()->getLocale());
        Carbon::setUtf8(true);
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
    protected function preferredLocale(?string $locale = null) : string
    {
        if ($this->isValidLanguage($language = $locale ?? $this->request->language)) {
            Cookie::queue('language', $language, 60 * 24 * 365);

            return $language;
        }

        if (! empty($this->request->cookie('language')) && $this->isValidLanguage($language = $this->request->cookie('language'))) {
            return $language;
        }

        return explode('_', $this->request->getPreferredLanguage())[0];
    }

    /**
     * Check if a given language is authorized in the config file.
     */
    protected function isValidLanguage(?string $language) : bool
    {
        return in_array($language, array_keys(config('polyglot.languages', ['en'])));
    }
}
