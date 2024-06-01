<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $table    =   "umum_gedung";
    protected $guarded  = [];

    public function getTandatangan()
    {
        return $this->hasOne('App\XFiles','xmarking','marking');
    }
}
