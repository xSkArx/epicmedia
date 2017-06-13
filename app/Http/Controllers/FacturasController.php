<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
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
        //dd(Input::all());

        $fecha1 = (Session::has('fecha1')) ? Session::get('fecha1') : Date::now()->startOfMonth();
        $fecha2 = (Session::has('fecha2')) ? Session::get('fecha2') : Date::now();
        $user = Auth::user();
        if (!Session::has('empresa')) Session::put('empresa', $user->empresas->first());
        $sesionEmpresa = Session::get('empresa');
        $facturas = null;
        $orden = Input::has('ordena') ? Input::get('ordena') : 1;
        $tipo = Input::has('tipo') ? Input::get('tipo') : 1;
        //dd(Route::current()->uri);
        switch (Route::current()->uri) {
            case 'app/facturas/ingresos':
                $m_id_factura = "id_factura_emitida";
                $m_facturas = "facturas_emitidas";
                $m_titulo = "Ingresos";
                $m_xls = "ingresos";
                $m_zip = "emitidas";
                $m_color = "green-jungle";
                $m_dfact = "download_factura_emitida";
                $m_filtrado_nombre = "Cliente";
                $m_factura_html = 2;
                break;
            case 'app/facturas/gastos':
                $m_id_factura = "id_factura_recibida";
                $m_facturas = "facturas_recibidas";
                $m_titulo = "Gastos";
                $m_xls = "gastos";
                $m_zip = "recibidas";
                $m_color = "red-thunderbird";
                $m_dfact = "download_factura_recibida";
                $m_filtrado_nombre = "Proveedor";
                $m_factura_html = 1;
                break;

        }
        $ordena = "";
        switch ($orden) {

            //Fecha
            case '1':
                if ($tipo == 2) {
                    $ordena = "fecha DESC, {$m_id_factura} DESC";
                } else {
                    $ordena = "fecha ASC, {$m_id_factura} DESC";
                }
                break;

            //RFC
            case '2':
                if ($tipo == 2) {
                    $ordena = "rfc DESC, fecha DESC";
                } else {
                    $ordena = "rfc ASC, fecha DESC";
                }
                break;

            //Razón Social
            case '3':
                if ($tipo == 2) {
                    $ordena = "razon_social DESC, fecha DESC";
                } else {
                    $ordena = "razon_social ASC, fecha DESC";
                }
                break;

            //Método de pago
            case '4':
                if ($tipo == 2) {
                    $ordena = "metodo_real DESC, fecha DESC";
                } else {
                    $ordena = "metodo_real ASC, fecha DESC";
                }
                break;

            //Tipo de factura
            case '5':
                if ($tipo == 2) {
                    $ordena = "tipo_cfdi DESC, fecha DESC";
                } else {
                    $ordena = "tipo_cfdi ASC, fecha DESC";
                }
                break;

            //Sub-total
            case '6':
                if ($tipo == 2) {
                    $ordena = "subtotal DESC, fecha DESC";
                } else {
                    $ordena = "subtotal ASC, fecha DESC";
                }
                break;

            //iva
            case '7':
                if ($tipo == 2) {
                    $ordena = "importe DESC, fecha DESC";
                } else {
                    $ordena = "importe ASC, fecha DESC";
                }
                break;

            //Total
            case '8':
                if ($tipo == 2) {
                    $ordena = "total DESC, fecha DESC";
                } else {
                    $ordena = "total ASC, fecha DESC";
                }
                break;
        }
        DB::enableQueryLog();
        $facturas = DB::table($m_facturas)->where("id_empresa", "=", $sesionEmpresa->id_empresa)->whereBetween('fecha', [$fecha1, $fecha2])->orderByRaw($ordena)->get();

        //dd($facturas);
        $proveedores = $facturas->sortBy('razon_social')->groupBy('rfc')->transform(function ($item, $k) {
            return $item->groupBy('razon_social')->keys();
        })->toArray();

        if (Input::has('proveedor')) {
            $facturas = $facturas->where('rfc', "=", Input::get('proveedor'));
        }
        $color_verde = "#23b176";
        $color_rojo = "#bf0606";
        $ocultar_refresh = false;
        $color_i = $color_rojo;
        $icono_i = "fa fa-exclamation-circle";
        $texto_i = "[Usuario Expirado]";

        $uri = Route::current()->uri;
        $uri2 = Input::has('tipo') ? Input::get('tipo') == 1 ? "&tipo=2" : "&tipo=1" : "&tipo=1" . Input::has('proveedor') ? "&proveedor=" . Input::get('proveedor') : "";

        $html = [
            'titulo' => $m_titulo,
            'xls' => $m_xls,
            'zip' => $m_zip,
            'color' => $m_color,
            'dfact' => $m_dfact,
            'filtrar' => $m_filtrado_nombre,
            'factura_html' => $m_factura_html,
            "id_factura" => $m_id_factura,
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
            'uri' => $uri,
            'uri2' => $uri2,
        ]);
    }
}
