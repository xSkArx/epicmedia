<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Auth;

class FacturasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function facturas()
    {

        $fecha1 = (Session::has('fecha1')) ? Session::get('fecha1') : Date::now()->startOfMonth();
        $fecha2 = (Session::has('fecha2')) ? Session::get('fecha2') : Date::now();
        $user = Auth::user();
        if (!Session::has('empresa')) Session::put('empresa', $user->empresas->first());
        $sesionEmpresa = Session::get('empresa');
        $facturas = null;
        //dd(Route::current()->uri);
        switch (Route::current()->uri) {
            case 'app/facturas/ingresos':
                $facturas = $sesionEmpresa->facturasEmitidas->filter(function ($factura) use ($fecha1, $fecha2) {
                    return $factura->fecha >= $fecha1->format('Y-m-d') && $factura->fecha <= $fecha2->format('Y-m-d');
                });
                $m_id_factura = "id_factura_emitida";
                $m_facturas = "facturas_emitidas";
                $m_titulo = "Ingresos";
                $m_xls = "ingresos";
                $m_zip = "emitidas";
                $m_color = "green-jungle";
                $m_dfact= "download_factura_emitida";
                $m_filtrado_nombre = "Cliente";
                $m_factura_html = 2;
                break;
            case 'app/facturas/gastos':
                $facturas = $sesionEmpresa->facturasRecibidas->filter(function ($factura) use ($fecha1, $fecha2) {
                    return $factura->fecha >= $fecha1->format('Y-m-d') && $factura->fecha <= $fecha2->format('Y-m-d');
                });
                $m_id_factura = "id_factura_recibida";
                $m_facturas = "facturas_recibidas";
                $m_titulo = "Gastos";
                $m_xls = "gastos";
                $m_zip = "recibidas";
                $m_color = "red-thunderbird";
                $m_dfact= "download_factura_recibida";
                $m_filtrado_nombre = "Proveedor";
                $m_factura_html = 1;
                break;

        }
        $proveedores = $facturas->sortBy('razon_social')->groupBy('rfc')->transform(function ($item, $k){
            return $item->groupBy('razon_social')->keys();
        })->toArray();
        /*echo '<pre>';
        foreach ($proveedores as $k => $v) {
            echo $k. " " .$v. "\n";
        } die();*/
        //dd($proveedores);
        //die($proveedores->toJson());
        //dd(Route::current()->uri);
        $color_verde = "#23b176";
        $color_rojo = "#bf0606";
        $ocultar_refresh = false;
        $color_i = $color_rojo;
        $icono_i = "fa fa-exclamation-circle";
        $texto_i = "[Usuario Expirado]";

        $html = [
            'titulo' => $m_titulo,
            'xls' => $m_xls,
            'zip' => $m_zip,
            'color' => $m_color,
            'dfact' => $m_dfact,
            'filtrar' => $m_filtrado_nombre,
            'factura_html' => $m_factura_html,
        ];
        if (!$sesionEmpresa->primera_descarga) {
            if ($user->vip) {
                $icono_i = ($user->id_paquete == 0) ? "fa fa-star-o" : "fa fa-star";
                $color_i = $color_verde;
                $texto_i = "[Plan " . ucwords(strtolower(($user->paquete) ? $user->paquete->paquete : 'Gratuito')) . "]";
            }
        } else {
            $ocultar_refresh = true;
            $icono_i = "fa fa-refresh";
            $texto_i = "[Descargando Facturas del SAT]";
        }

        return view('app.facturas')->with([
            'usuario' => $user,
            'sesionEmpresa' => $sesionEmpresa,
            'facturas' => $facturas,
            'fechas' => [$fecha1, $fecha2],
            "bread" => [
                'color' => $color_i,
                'icono' => $icono_i,
                'texto' => $texto_i,
                'refresh' => $ocultar_refresh
            ],
            'html' => $html,
            'proveedores' => $proveedores,
        ]);
    }
}
