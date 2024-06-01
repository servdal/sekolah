<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table    = "db_pengumuman";
    public $timestamps  = false;
    protected $guarded  = [];
}
