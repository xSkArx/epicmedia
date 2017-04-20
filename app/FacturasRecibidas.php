<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturasRecibidas extends Model
{
    protected $table = "facturas_recibidas";
    protected $primaryKey = "id_factura_recibida";
    public $timestamps = false;

    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'id_empresa');
    }
}
