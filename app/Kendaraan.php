<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table    =   "umum_kendaraan";
    public $timestamps  =   false;
    protected $guarded  = [];
}
