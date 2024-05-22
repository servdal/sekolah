<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    protected $table    =   "db_tabungan";
    public $timestamps  =   false;
    protected $fillable =  [
        'noinduk', 
        'nama',
        'debet',
		'kredit',
		'keterangan',
		'verified',
		'marking',
		'inputor','id_sekolah'
    ];
}
