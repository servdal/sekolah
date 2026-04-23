<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapotan extends Model
{
    protected $table    =   "db_rapotan";
    public $timestamps  =   false;
    protected $guarded  = [];
    public function getDataInduk()
    {
        return $this->hasOne('App\Datainduk','noinduk','noinduk');
    }
}
