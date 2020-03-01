<?php

namespace BC\Laravel\Polyglot\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class RootController
{
    public function __invoke(Request $request) : RedirectResponse
    {
        return redirect()->to(config('app.fallback_locale'));
    }
}
