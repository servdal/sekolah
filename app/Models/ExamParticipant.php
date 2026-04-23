<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamParticipant extends Model
{
    protected $fillable = [
        'exam_id',
        'student_id',
        'noinduk',
        'nama',
        'kelas',
        'status',
        'mulai_pada',
        'selesai_pada',
        'total_nilai'
    ];


    protected $casts = [
        'mulai_pada' => 'datetime',
        'selesai_pada' => 'datetime',
    ];

    public function exam()
    {
        return $this->belongsTo(\App\Models\Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(DbDataInduk::class, 'student_id');
    }
}
