<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XFiles extends Model
{
    protected $table        = "x_files";
    protected $primaryKey   = "xid";
    public $timestamps      = false;
    protected $guarded      = [];

}
