<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsMember
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isMember()) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}

