<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RencanaKegiatan extends Model
{
    //
    protected $table = "db_rencanakegiatan";
    protected $guarded  = [];

    public function getTandatangan()
    {
        return $this->hasOne('App\XFiles','xmarking','marking');
    }
    public function getTeksProposal()
    {
        return $this->hasOne('App\XFiles','xmarking','markingteksproposal');
    }
}
