<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    protected $fillable = [
        'created_by',
        'mapel',
        'kelas',
        'tipe',
        'stimulus',
        'pertanyaan',
        'bobot'
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function options()
    {
        return $this->hasMany(QuestionBankOption::class);
    }
    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_questions');
    }
    public function matchingLefts()
    {
        return $this->hasMany(MatchingLeft::class);
    }

    public function matchingRights()
    {
        return $this->hasMany(MatchingRight::class);
    }


    /** Jawaban siswa */
    public function answers()
    {
        return $this->hasMany(StudentAnswer::class);
    }
}
