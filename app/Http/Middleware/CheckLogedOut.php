<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

//use Auth;

class CheckLogedOut
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
        if(Auth::guest()){
            if($request->expectsJson()){
                return response()->json([
                    'message' => 'Unauthenticated',
                ], 401);
            }
            return redirect()->intended('login-auth');
        }
        return $next($request);
    }
}
