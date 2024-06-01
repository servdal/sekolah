<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HPTKeuangan extends Model
{
    protected $table    	=   "db_keuangan";
	protected $guarded  = [];

    public function getTandatangan()
    {
        return $this->hasOne('App\XFiles','xmarking','marking');
    }
}
