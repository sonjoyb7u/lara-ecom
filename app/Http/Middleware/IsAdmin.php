<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->is_admin === 1) {
            return $next($request);

        }

        return redirect()->route('admin.home')->with('errorMsg', 'You don\'t have an Super Admin Dashboard access!');

    }
}
