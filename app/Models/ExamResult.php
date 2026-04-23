<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = [
        'exam_id',
        'student_id',
        'total_nilai',
        'nilai_pg',
        'nilai_esai',
        'status'
    ];

    public function exam()
    {
        return $this->belongsTo(\App\Models\Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }
}
