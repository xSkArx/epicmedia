<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    protected $table = "membresia";

    protected $primaryKey = "id_membresia";

    public $timestamps = false;
}
