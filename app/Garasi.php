<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garasi extends Model
{
    protected $table    =   "umum_garasi";
    protected $guarded  = [];

    public function getTandatangan()
    {
        return $this->hasOne('App\XFiles','xmarking','marking');
    }
}
