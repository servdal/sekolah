<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'exam_id',
        'nomor',
        'tipe',
        'stimulus',
        'pertanyaan',
        'bobot'
    ];

    /** Ujian induk */
    public function exam()
    {
        return $this->belongsTo(\App\Models\Exam::class);
    }

    /** Opsi jawaban (PG, kompleks, benar/salah) */
    public function options()
    {
        return $this->hasMany(\App\Models\QuestionOption::class);
    }

    /** Menjodohkan - kiri */
    public function matchingLefts()
    {
        return $this->hasMany(\App\Models\MatchingLeft::class);
    }

    /** Menjodohkan - kanan */
    public function matchingRights()
    {
        return $this->hasMany(\App\Models\MatchingRight::class);
    }

    /** Jawaban siswa */
    public function answers()
    {
        return $this->hasMany(\App\Models\StudentAnswer::class);
    }
}
