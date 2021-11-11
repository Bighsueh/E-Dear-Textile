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
        //Session->level
        $level = '';

        //check login status
        if (!$request->session()->has('level')) {
            //查無Session->level,return get_login
            return redirect()->route('get_login');
        }
        //get session "level"
        $level = Session::get('level');

        //check uri contains string of level and "Scan"
        //strpos函數找到值會回傳字串，找不到會回傳false
        if (!(strpos($request_uri, $level) === false) and !(strpos($request_uri, "Scan") === false)) {
            //當level跟"Scan"字眼同時找不到則return get_login
            return redirect()->route('get_login');
        }

        //該有的都有，回傳$next($request)
        return $next($request);
    }
}
