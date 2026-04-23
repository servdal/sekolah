<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'kode_ujian',
        'nama_ujian',
        'mapel',
        'jenjang',
        'durasi_menit',
        'tanggal_mulai',
        'tanggal_selesai',
        'exam_password',
        'status',
        'created_by',
        'id_sekolah'
    ];


    protected $casts = [
        'acak_soal' => 'boolean',
        'acak_opsi' => 'boolean',
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class);
    }


    /** Peserta ujian */
    public function participants()
    {
        return $this->hasMany(\App\Models\ExamParticipant::class);
    }

    public function bankSoals()
    {
        return $this->belongsToMany(
            \App\Models\QuestionBank::class,
            'exam_questions'
        )->withPivot('nomor');
    }

}
