<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $user = Auth::user();
        if (!Session::has('empresa')) Session::put('empresa', $user->empresas->first());
        //dd($user->empresas);
        $sesionEmpresa = Session::get('empresa');
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
        return view('app.home', ["usuario" => $user, 'sesionEmpresa' => $sesionEmpresa, "bread" => [
            'color' => $color_i,
            'icono' => $icono_i,
            'texto' => $texto_i,
            'refresh' => $ocultar_refresh
        ]]);
    }
}
