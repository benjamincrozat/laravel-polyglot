<?php

namespace BC\Laravel\Polyglot\Middlewares;

use Closure;

class Localized
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure                  $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        app()->setLocale($request->route()->getPrefix());

        return $next($request);
    }
}
