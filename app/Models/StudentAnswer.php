<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $fillable = [
        'exam_id',
        'question_bank_id',
        'student_id',
        'jawaban',
        'nilai'
    ];

    protected $casts = [
        'jawaban' => 'array'
    ];

    public function exam()
    {
        return $this->belongsTo(\App\Models\Exam::class);
    }

    public function question()
    {
        return $this->belongsTo(\App\Models\Question::class);
    }

    public function student()
    {
        return $this->belongsTo(DbDataInduk::class, 'student_id');
    }
}
