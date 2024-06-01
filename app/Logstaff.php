<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logstaff extends Model
{
    protected $table    = "db_logstaff";
    protected $guarded  = [];

    public function getDataInduk()
    {
        return $this->hasOne('App\Dataindukstaff','niy','sopo');
    }
}
