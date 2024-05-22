<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table    =   "db_pembayaran";
    public $timestamps      =   false;
    protected $guarded  = [];
}
