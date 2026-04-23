<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MushafUjianLisan extends Model
{
    protected $table    = "mushaf_ujianlisan";
    protected $guarded  = [];
    public function getTandatangan()
    {
        return $this->hasOne('App\XFiles','xmarking','marking');
    }
}
