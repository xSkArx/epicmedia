<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('app');
    }
    return view('portada');
});

Route::get('/privacidad', function () {
    return view('privacidad');
});

Route::get('/politicas', function () {
    return view('politicas');
});

Auth::routes();
Route::group(['prefix' => 'app'], function () {

    Route::get('/', ['as' => 'app', 'uses' => 'HomeController@index']);
    Route::post('/', 'HomeController@postIndex');
    Route::get('/facturas/ingresos', 'FacturasController@facturas');
    Route::get('/facturas/gastos', 'FacturasController@facturas');

});

Route::get('js/charts', function () {

    if (!Auth::check()) {
        abort(403, 'Unauthorized action.');
    }
    $sesionEmpresa = Session::has('empresa') ? Session::get('empresa') : Auth::user()->empresas->first();
    $inicio = Jenssegers\Date\Date::parse('first day of january');
    $fin = Jenssegers\Date\Date::now();
    $fin->modify('last day of this month');
    $interval = DateInterval::createFromDateString('1 month');
    $period = new DatePeriod($inicio, $interval, $fin);
    $datojs = "";
    $tipo_chart = Session::has('chart') ? Session::get('chart') : "emitidas";
    $facturas = $tipo_chart == "emitidas" ? $sesionEmpresa->facturasEmitidas : $sesionEmpresa->facturasRecibidas;
    $sumas = [];
    foreach ($period as $dt) {
        $suma = $facturas->filter(function ($f) use ($dt) {
            return $f->fecha >= $dt->startOfMonth()->format('Y-m-d') && $f->fecha <= $dt->endOfMonth()->format('Y-m-d') && $f->id_tipo_cfdi == 1;
        })->sum('total');
        $sumas[] = "['" . str_limit($dt->format('M'), 3, "") . " " . $dt->format('Y') . "', " . (empty($suma) ? 0 : $suma) . "],";
    }
    $contents = View::make('app.js.chart')->with('datos', $sumas);
    $response = Response::make($contents, 200);
    $response->header('Content-Type', 'application/javascript');
    return $response;
});
