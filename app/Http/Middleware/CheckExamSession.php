<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ExamParticipant;

class CheckExamSession
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Cek apakah ada session peserta
        if (!session()->has('participant_id') || !session()->has('exam_id')) {
            return redirect()->route('exam.login')->with('error', 'Silakan login ujian terlebih dahulu.');
        }

        // 2. Validasi Ulang Status di Database (Security Check)
        $participant = ExamParticipant::find(session('participant_id'));
        
        if (!$participant || $participant->status == 'selesai') {
            session()->flush();
            return redirect()->route('exam.login')->with('error', 'Ujian Anda sudah selesai atau tidak valid.');
        }

        // 3. Cek apakah Waktu Habis (Server Side Check)
        // Jika waktu sekarang > selesai_pada, otomatis tendang
        if ($participant->selesai_pada && now() > $participant->selesai_pada) {
            $participant->update(['status' => 'selesai']);
            session()->flush();
            return redirect()->route('exam.login')->with('error', 'Waktu ujian telah habis.');
        }

        return $next($request);
    }
}