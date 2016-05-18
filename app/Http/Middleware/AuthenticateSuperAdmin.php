<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticateAdmin
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
            return redirect()->guest('/');
        }
        
        if(Auth::user()->user_type != 2){
            return 'Not authorized';
        }

        return $next($request);
    }
}
