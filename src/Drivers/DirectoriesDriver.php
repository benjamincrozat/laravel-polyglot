<?php

namespace BC\Laravel\Polyglot\Drivers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DirectoriesDriver
{
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
