<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchingKey extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'left_id',
        'right_id'
    ];

    public function left()
    {
        return $this->belongsTo(MatchingLeft::class);
    }

    public function right()
    {
        return $this->belongsTo(MatchingRight::class, 'right_id');
    }
}
