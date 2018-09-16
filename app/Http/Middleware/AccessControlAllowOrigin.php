<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use App\Http\Controllers\Controller;

class AccessControlAllowOrigin
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
        //允许跨域请求
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
        $allow_ajax_domain = explode(',', env('ALLOW_AJAX_DOMAIN', ''));
        if(in_array($origin, $allow_ajax_domain)) {
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: ". $origin);
        }
        return $next($request);
    }
}
