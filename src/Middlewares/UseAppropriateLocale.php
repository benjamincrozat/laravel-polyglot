<?php

namespace BC\Laravel\Polyglot\Middlewares;

use Closure;
use BC\Laravel\Polyglot\Facades\Polyglot;

class UseAppropriateLocale
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
        Polyglot::setLocale();

        return $next($request);
    }
}
