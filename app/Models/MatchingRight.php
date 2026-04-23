<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchingRight extends Model
{
    protected $fillable = [
        'question_bank_id',
        'label',
        'teks'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function key()
    {
        return $this->hasOne(MatchingKey::class, 'right_id');
    }

    
}
