<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = "db_mstsekolah";

    protected $guarded = [];

    public function kepala_sekolah()
    {
        return $this->hasOne('App\Dataindukstaff','id','id_kepala_sekolah');
    }
}
