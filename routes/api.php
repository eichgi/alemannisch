<?php

use App\Ejercicio;
use App\Pronombre;
use App\PronombreTipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/registro', 'UserController@registro');
Route::post('/login', 'UserController@login');

Route::get('/pronombres/{tipo}', function ($tipo) {
    $pronombre_tipo = PronombreTipo::where('nombre', $tipo)->first();
    $pronombres = Pronombre::where('pronombre_tipo_id', $pronombre_tipo->id)->get();
    $descripcion = $pronombre_tipo->descripcion;
    $enlace = $pronombre_tipo->enlace;
    $ejercicio_id = $pronombre_tipo->ejercicio_id;
    return response()->json(['data' => compact('pronombres', 'descripcion', 'enlace', 'ejercicio_id'), 'status' => 200]);
});

Route::post('/saveToRecord', 'HistorialEjerciciosController@store');
Route::post('/getRecord', 'HistorialEjerciciosController@index');

Route::get('/verbos/{categoria}/niveles', 'VerbosController@niveles');
Route::get('/verbos/{categoria}/{nivel}', 'VerbosController@show');










