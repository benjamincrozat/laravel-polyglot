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
    public function prefix()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale()
    {
        app()->setLocale(
            $this->preferredLocale()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function switchTo($language)
    {
        return $this->request->fullUrlWithQuery(compact('language'));
    }

    /**
     * @return string
     */
    protected function preferredLocale()
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
     * @param string $language
     *
     * @return bool
     */
    protected function isValidLanguage($language)
    {
        return in_array($language, array_keys(config('polyglot.languages') ?? ['en']));
    }
}
