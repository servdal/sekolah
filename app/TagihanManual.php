<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagihanManual extends Model
{
    protected $table    = "db_tagihanmanual";
    protected $guarded  = [];
    public function getDataInduk()
    {
        return $this->hasOne('App\Datainduk','id','idsiswa');
    }
}
