<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table    =   "db_beasiswa";
    protected $guarded = [];
    public function getLampiran()
    {
        return $this->hasOne('App\XFiles','xmarking','nmfile');
    }
}
