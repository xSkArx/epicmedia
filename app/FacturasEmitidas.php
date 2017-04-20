<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturasEmitidas extends Model
{
    protected $table = "facturas_emitidas";
    protected $primaryKey = "id_factura_emitida";
    public $timestamps = false;

    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'id_empresa');
    }
}
