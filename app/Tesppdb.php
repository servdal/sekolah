<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tesppdb extends Model
{
    protected $table    =   "db_tesppdb";
    public $timestamps  =   false;
    protected $fillable =  [
		'hari', 'jam', 'materi', 'nama', 'tanggal', 'ruang','id_sekolah'
    ];
}
