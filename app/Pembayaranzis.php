<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaranzis extends Model
{
    protected $table    = "db_pembayaranzis";
    protected $guarded  = [];

    public function getTandatangan()
    {
        return $this->hasOne('App\XFiles','xmarking','marking');
    }
}
