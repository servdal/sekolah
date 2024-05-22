<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table    =   "db_peminjamanbuku";
    public $timestamps  =   false;
    protected $guarded = [];

}
