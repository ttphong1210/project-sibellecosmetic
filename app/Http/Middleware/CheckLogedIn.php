<?php

namespace App\Http\Middleware;

use Closure;
//use Auth;
use Illuminate\Support\Facades\Auth;

class CheckLogedIn
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
        if(Auth::check()){
            return redirect('admin/home');
        };
        return $next($request);
    }
}
