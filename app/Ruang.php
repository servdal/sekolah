<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $table    = "umum_ruang";
    protected $guarded  = [];

    public function getTandatangan()
    {
        return $this->hasOne('App\XFiles','xmarking','marking');
    }
}
