<?php

namespace App\Http\Middleware;

use Closure;
use Session;

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
        $response   =   $next($request);
        $allowedEmails = ['servdal@gmail.com', 'swandhana17@gmail.com', 'info@sdtqdu.sch.id']; // Tambahkan email yang diizinkan

        // Cek apakah email pengguna yang login ada dalam daftar yang diizinkan
        if (!in_array(Session('email'), $allowedEmails)) {
            $data['kalimatheader']  	= 'Mohon Maaf';
        	$data['kalimatbody']  		= Session('email').' Laman ini menggunakan hak akses spesial';
            return view('errors.notready', $data);
        }
        if ( Session('id') != 2 ) {
            return redirect('/');
        }

        return $response;
    }
}
