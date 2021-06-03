<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->address->address == null) {
            return redirect()->route('profile.show')->with('info', 'Ensure you have entered your billing address information');
        }

        return $next($request);
    }
}
