<?php

namespace Serverfireteam\Panel\libs;

use Lang;
use Closure;

class AuthMiddleware
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

        if (is_null(\Auth::guard('panel')->user())) {
            $message = session('message', Lang::get('panel::fields.enterEmail'));

            return redirect('/panel/login')
                ->with('message', $message)
                ->with('mesType', 'message');
        }

        return $next($request);
    }
}
