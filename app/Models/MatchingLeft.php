<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchingLeft extends Model
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

    public function keys()
    {
        return $this->hasMany(MatchingKey::class, 'left_id');
    }
    public function key()
    {
        return $this->hasOne(MatchingKey::class, 'left_id');
    }
    public function right()
    {
        return $this->belongsTo(MatchingRight::class, 'right_id');
    }
}
