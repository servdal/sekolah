<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthProjectUjian
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
        $response   =   $next($request);
        if ( !$request->session()->has('username') && !$request->session()->has('password') ) {
            return redirect('/');
        }
        return $response;
    }
}
