<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Organization;
use Auth;

class AuthenticateWithOrganization
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

        $slug = explode('.',$request->getHost());

        if(Auth::guest()){

            return redirect()->guest('/');
        }

        if(Organization::where('slug',$slug[0])->where('id',Auth::user()->organization_id)->first()){
            return $next($request);
        }

        
        return redirect()->guest('/');

    }
}
