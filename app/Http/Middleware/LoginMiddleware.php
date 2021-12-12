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

        //若admin則放行
        if ($level == 'admin') {
            return $next($request);
        }

        //若為掃描器uri則放行
        if(strpos($request_uri, "Scan") !== false){
            return $next($request);
        }

        //若uri包含level則放行
        if ((strpos($request_uri, $level) !== false)) {
            return $next($request);
        }

        //剩下沒過的都刷掉
        return redirect()->route('get_login');
    }
}
