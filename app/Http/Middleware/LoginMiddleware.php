<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //get request uri
        $request_uri = $request->getRequestUri();

        $level = '';

        //check login status
        if (!$request->session()->has('level')) {
            //if no,return get_login
            return redirect()->route('get_login');
        } else {
            //if yes, get session "level"
            $level = Session::get('level');
        }

        //check uri contains string of level
        if (!strpos($request_uri, $level) !== false) {
            return redirect()->route('get_login');
        }

        //該有的都有，回傳$next($request)
        return $next($request);
    }
}
