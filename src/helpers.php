<?php

if (! function_exists('polyglot')) {
    /**
     * Resolve the Polyglot instance from the container.
     *
     * @return BC\Laravel\Polyglot\Polyglot
     */
    function polyglot()
    {
        return app('polyglot');
    }
}
