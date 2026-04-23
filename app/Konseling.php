<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konseling extends Model
{
    protected $table    =   "db_konseling";
    protected $guarded  = [];
    public function getDesTatib()
    {
        return $this->hasOne('App\Tatib','kode','jenis');
    }
}
