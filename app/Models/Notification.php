<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Notification extends Model
{
    protected $table = "notifications";

    protected $fillable = [ 'type', 'notifiable_id', 'notifiable_type', 'data', 'read_at', 'user_id', 'created_at', 'updated_at', ];
    public function setDataAttribute($data) 
    { 
        $this->attributes['data'] = json_encode($data); 
    } 
}
