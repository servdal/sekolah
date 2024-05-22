<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatting extends Model
{
    protected $table    =   "pesan";
    public $timestamps  =   false;
    protected $guarded  = [];
}
