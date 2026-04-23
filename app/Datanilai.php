<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Datanilai extends Authenticatable
{
    protected $table    =   "db_nilai";
    public $timestamps  =   false;
    protected $guarded  = [];
}
