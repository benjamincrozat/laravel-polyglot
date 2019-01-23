<?php

use BC\Laravel\Polyglot\Polyglot;

if (! function_exists('polyglot')) {
    /**
     * Get the Polyglot instance from the container.
     */
    function polyglot() : Polyglot
    {
        return app('polyglot');
    }
}
