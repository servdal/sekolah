<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datapelengkappsb extends Model
{
    protected $table    = "db_pelengkappsb";
    public $timestamps  = false;
    protected $guarded  = [];
    public function getPSBAkta()
    {
        return $this->hasOne('App\XFiles','xmarking','scanakta');
    }
    public function getPSBFoto()
    {
        return $this->hasOne('App\XFiles','xmarking','scanfoto');
    }
    public function getPSBKK()
    {
        return $this->hasOne('App\XFiles','xmarking','scankk');
    }
    public function getPSBKet()
    {
        return $this->hasOne('App\XFiles','xmarking','scanket');
    }
    public function getPSBBukti()
    {
        return $this->hasOne('App\XFiles','xmarking','scanbukti');
    }
}
