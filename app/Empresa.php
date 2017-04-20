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

    public function facturasRecibidas()
    {
        return $this->hasMany('App\FacturasRecibidas', 'id_empresa');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'id_usuario');
    }

    public function facturasEmitidas() {
        return $this->hasMany('App\FacturasEmitidas', 'id_empresa');
    }
}
