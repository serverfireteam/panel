<?php

namespace Serverfireteam\Panel\libs;

use Lang;
use Closure;
use Gate;

use Serverfireteam\Panel\Admin;

class PermissionCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    protected $app;
    public function handle($request, Closure $next)
    {   

        $admin= Admin::find((\Auth::user()->id));
        
        $urlSegments   = $request->segments();

        if ($admin->hasRole('admin')){

            return $next($request);
        }else{
            if (key_exists(2 , $urlSegments)){

                $PermissionToCheck = 'view /' . $urlSegments[1] . '/' . $urlSegments[2];

                if($admin->hasPermissionTo($PermissionToCheck)){

                    return $next($request);
                }else{
                    /**
                     * Show Access denied page to User
                     */
                    
                    abort(403);
                }
            }
            return $next($request);

        }

    }
}
