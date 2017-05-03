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

});
/*
Route::get('/js/charts', function(){
    $content = View::make('js.chart')->with('datos', [

    ]);
});*/

Route::get('/s', function(){
    return get_class(App\Empresa::find(217)->facturasEmitidas);
});