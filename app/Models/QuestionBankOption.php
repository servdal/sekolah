<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionBankOption extends Model
{
    protected $fillable = [
        'question_bank_id',
        'label',
        'teks',
        'is_correct',
        'urutan'
    ];

    protected $casts = [
        'is_correct' => 'boolean'
    ];

    public function question()
    {
        return $this->belongsTo(\App\Models\Question::class);
    }
}
