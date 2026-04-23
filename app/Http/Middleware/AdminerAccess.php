<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class AdminerAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            $data['kalimatheader']  	= 'Mohon Maaf';
        	$data['kalimatbody']  		= 'Laman ini menggunakan hak akses spesial';
            return view('errors.notready', $data);
        }

        // Ambil email yang diizinkan
        $allowedEmails = ['servdal@gmail.com', 'swandhana17@gmail.com', 'info@sdtqdu.sch.id']; // Tambahkan email yang diizinkan

        // Cek apakah email pengguna yang login ada dalam daftar yang diizinkan
        if (!in_array(Auth::user()->email, $allowedEmails)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
