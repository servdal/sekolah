<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
abstract class Controller
{
    public function getFotoUrl($foto)
    {
        // Cek apakah file fisik ada di storage local
        if ($foto && Storage::disk('local')->exists('/dist/img/foto/' . $foto)) {
            return url("/") . '/dist/img/foto/' . $foto;
        }

        // Jika tidak ada, kembalikan logo sekolah dari session
        return url("/") . '/' . session('sekolah_logo');
    }
}
