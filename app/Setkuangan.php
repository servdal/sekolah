<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setkuangan extends Model
{
    protected $table    =   "db_setkeuangan";
    public $timestamps  =   false;
    protected $fillable =  [
        'nama', 
		'noinduk', 
		'dpp',
		'spp',
		'paguyuban',
		'eksul1',
		'eksul2',
		'eksul3',
		'eksul4',
		'eksul5','id_sekolah'
    ];
}
