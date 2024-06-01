<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table    =   "db_prestasi";
    protected $guarded  = [];

    public function getTandatangan()
    {
        return $this->hasOne('App\XFiles','xmarking','namafile');
    }
}
