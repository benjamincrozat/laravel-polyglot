<?php

namespace BC\Laravel\Polyglot\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class RootController
{
    public function __invoke(Request $request) : RedirectResponse
    {
        $preferredLanguage = explode('_', $request->getPreferredLanguage())[0];

        return redirect()->to(
            -1 === array_key_exists($preferredLanguage, config('polyglot.languages'))
                ? config('app.fallback_locale')
                : $preferredLanguage
        );
    }
}
