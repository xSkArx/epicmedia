<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table = "paquetes";

    protected $primaryKey = "id_paquete";

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\User', 'id_paquete');
    }
}
