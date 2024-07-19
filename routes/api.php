<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Bike;
use App\Http\Controllers\BikeApiController;

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

//recuperar todas las motos
Route::get(
    '/motos',
    [BikeApiController::class, 'index']
);

//recuperar una moto por id
Route::get(
    '/moto/{id}',
    [BikeApiController::class, 'show']
)->where('bike', '^\d+$');

//buscar una moto por marca, modelo a matrícula
Route::get(
    '/motos/{campo}/{valor}',
    [BikeApiController::class, 'search']
)->where('campo', '^marca|modelo|matricula$');

//añadir una moto
Route::post(
    '/moto',
    [BikeApiController::class, 'store']
);

//modificar una moto
Route::put(
    '/moto/{bike}',
    [BikeApiController::class, 'update']
);

//borrar una moto
Route::delete(
    '/moto/{bike}',
    [BikeApiController::class, 'delete']
);

//ruta de fallback: se ha producido una petición incorrecta
Route::fallback(
    function () {
        return response(['status' => 'BAD REQUEST'], 400);
});
