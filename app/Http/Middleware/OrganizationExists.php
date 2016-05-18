<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use App\Models\Organization;

use Illuminate\Support\Facades\Config;

class OrganizationExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        // $slug = $request->getHost();

        $slug = explode('.',$request->getHost());

        if(strcmp($slug[0],'api') == 0){
            if(Organization::where('slug',$slug[1])->first()){
                return $next($request);
            }
        } else {
            if(Organization::where('slug',$slug[0])->first()){
                return $next($request);
            }    
        }
    
        return redirect(Config::get('app.url'));

    }
}
