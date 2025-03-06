<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccompagnatoreMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->role === 'accompagnatore') {
            return $next($request);
        }
        return redirect('/'); // Redirect se non è un accompagnatore
    }
}