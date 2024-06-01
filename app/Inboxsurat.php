<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inboxsurat extends Model
{
    protected $table    = "tbl_inbox";
    protected $guarded  = [];
    public function getTandatangan()
    {
        return $this->hasOne('App\XFiles','xmarking','xmarking');
    }
}
