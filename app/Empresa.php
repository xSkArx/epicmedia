<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $primaryKey = "id_empresa";

    protected $table = "empresas";

    public $timestamps = false;

    protected $fillable = [
        'razon_social', 'rfc', 'ciec',
    ];

    protected $hidden = [
        'ciec',
    ];

}
