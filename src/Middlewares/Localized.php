<?php

namespace BC\Laravel\Polyglot\Middlewares;

use Closure;

class Localized
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        app()->setLocale(
            trim($request->route()->getPrefix(), '/')
        );

        return $next($request);
    }
}
