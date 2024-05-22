<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class Login
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
        $response = $next($request);

        return $response;
    }

    public function terminate($request, $response)
    {
        if (! \Auth::check())
            return;

        $user = \Auth::user();

        if (!$user->session_id) {
            $user->session_id = \Session::getId();
            $user->last_activity = Carbon::now();
            $user->save();
        } else {
            $last_session = \Session::getHandler()->read($user->session_id);
            if ($last_session) {
                \Auth::logout();
                \Session::getHandler()->destroy(\Session::getId());
                \Session::flash('session', 'Someone already logged in.');
                $tasks['judulpesan']	= 'Session Not Valid';
				$tasks['kalimatheader']	= 'Mohon Relogin';
				$tasks['kalimatbody']	= 'Someone already logged in.';
				return view('errors.pesanerror', $tasks);
            }
        }
    }
}
