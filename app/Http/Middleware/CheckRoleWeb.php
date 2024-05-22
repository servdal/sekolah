<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleWeb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        $namarole   = session('role');
        $checkarray = array_search($namarole, $roles);

        if($checkarray===false){
            return redirect()->route('accessdenied')->send();
            //response()->view('landing');
        }
        return $next($request);
    }
}
