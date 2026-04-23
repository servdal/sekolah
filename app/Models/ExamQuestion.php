<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $fillable = [
        'exam_id',
        'question_bank_id',
        'nomor',
        'bobot'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function questionBank()
    {
        return $this->belongsTo(QuestionBank::class, 'question_bank_id');
    }
}
