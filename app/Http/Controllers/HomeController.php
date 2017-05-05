<?php

namespace App\Http\Controllers;

use App\Empresa;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Jenssegers\Date\Date;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fecha1 = (Session::has('fecha1')) ? Session::get('fecha1') : Date::now()->startOfMonth();
        $fecha2 = (Session::has('fecha2')) ? Session::get('fecha2') : Date::now();
        $user = Auth::user();
        if (!Session::has('empresa')) Session::put('empresa', $user->empresas->first());
        $sesionEmpresa = Session::get('empresa');
        $facturasEmitidas = $sesionEmpresa->facturasEmitidas->filter(function ($factura) use ($fecha1, $fecha2) {
            return $factura->fecha >= $fecha1->format('Y-m-d') && $factura->fecha <= $fecha2->format('Y-m-d') && $factura->id_tipo_cfdi == 1;
        })->sortByDesc('fecha')->sortByDesc('id_factura_emitida');
        $facturasRecibidas = $sesionEmpresa->facturasRecibidas->filter(function ($factura) use ($fecha1, $fecha2) {
            return $factura->fecha >= $fecha1->format('Y-m-d') && $factura->fecha <= $fecha2->format('Y-m-d') && $factura->id_tipo_cfdi == 1;
        })->sortByDesc('fecha')->sortByDesc('id_factura_recibida');
        if (!$user->vip) {
            $facturasEmitidas = $facturasEmitidas->take(5);
            $facturasRecibidas = $facturasRecibidas->take(5);
        }
        //dd($facturasRecibidas,$facturasEmitidas);


        $color_verde = "#23b176";
        $color_rojo = "#bf0606";
        $ocultar_refresh = false;
        $color_i = $color_rojo;
        $icono_i = "fa fa-exclamation-circle";
        $texto_i = "[Usuario Expirado]";

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
        return view('app.home', [
            "usuario" => $user,
            'sesionEmpresa' => $sesionEmpresa,
            'facturas' => [
                'recibidas' => $facturasRecibidas,
                'emitidas' => $facturasEmitidas
            ],
            "bread" => [
                'color' => $color_i,
                'icono' => $icono_i,
                'texto' => $texto_i,
                'refresh' => $ocultar_refresh
            ],
            "fechas" => [$fecha1, $fecha2]
        ]);
    }

    public function postIndex(Request $request)
    {
        if ($request->isMethod('post')) {
            if (Input::has('tipo_fecha')) {
                switch (Input::get('tipo_fecha')) {
                    case 1: //Mes en curso
                        Session::put('fecha1', Date::now()->startOfMonth());
                        Session::put('fecha2', Date::now());
                        break;
                    case 2: //Mes anterior
                        Session::put('fecha1', Date::now()->subMonth(1)->startOfMonth());
                        Session::put('fecha2', Date::now()->subMonth(1)->endOfMonth());
                        break;
                    case 3: //Anio actual
                        Session::put('fecha1', Date::parse('first day of january'));
                        Session::put('fecha2', Date::now());
                        break;
                }
            }

            if (Input::has('rango_fechas')) {
                list($fecha1, $fecha2) = explode('/', Input::get('rango_fechas'));
                Session::put('fecha1', Date::parse($fecha1));
                Session::put('fecha2', Date::parse($fecha2));
            }
        }
        return redirect('app');
    }
}
