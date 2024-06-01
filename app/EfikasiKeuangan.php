<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EfikasiKeuangan extends Model
{
    protected $table    = "db_efikasikeuangan";
    protected $guarded  = [];
    public function getTandatangan()
    {
        return $this->hasOne('App\XFiles','xmarking','marking');
    }
}
