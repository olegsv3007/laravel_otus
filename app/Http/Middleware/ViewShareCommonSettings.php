<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;


class ViewShareCommonSettings
{
    public function handle(Request $request, Closure $next)
    {
        View::share([
            'locale' => App::getLocale(),
            'parameters' => $request->all(),
        ]);

        return $next($request);
    }
}
