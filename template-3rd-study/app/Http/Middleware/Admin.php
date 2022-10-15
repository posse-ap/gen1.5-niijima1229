<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class Admin
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
        if (Auth::user()->role_id == 1) {
            return redirect(route('webapp'))->with('flash_message', '権限がありません');
        }
        return $next($request);
    }
}
