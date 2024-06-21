<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


// Probando ruta patata para que me lleve al welcomecontroller

Route::get('patata', [WelcomeController::class, 'index'])->name('welcome');

// CRUD de motos
Route::resource('bikes', BikeController::class);

// formulario de confirmación de eliminacion
Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])->name('bikes.delete');

//RUTA DE FALLBACK, ruta a la que irá si no coinciden las demás rutas.
Route::fallback([WelcomeController::class, 'index']);

// ruta para la confirmación de eliminación
Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])
    ->name('bikes.delete'); 

// ruta de test
Route::get('/test', function(){
    Log::info("Tienes un nuevo mensaje :D");

    return "Consulta el fichero de log.";
});

//ZONA PARA PRUEBAS (borrar al finalizar)
Route::get('saludar', function(){
    return 'Hola mundo :D';
});

/*Route::match(['PUt', 'DELETE'], 'test', function(Request $request){
    return 'Estás haciendo la prueba por '.$request->getMethod();
});*/

Route::redirect('test', 'bikes', 301);

/*Route::get('test', function(){
    return 'Estás haciendo la prueba por GET.';
});

Route::post('test', function(){
    return 'Estás haciendo la prueba por POST.';
});

Route::put('test', function(){
    return 'Estás haciendo la prueba por PUT.';
});

Route::delete('test', function(){
    return 'Estás haciendo la prueba por DELETE.';
});*/

// Nomes pasa per PUT o DELETE
/*Route::match(['PUT', 'DELETE'], 'test', function(Request $request){
    return 'Estás haciendo la prueba por '.$request->getMethod();
});*/

//Cualsevol entrada GET POST PUT DELETE val per retornar la request
/*Route::any('test', function(Request $request){
    return 'Estás haciendo la prueba por '.$request->getMethod();
});*/

//Redireccióna pasant per ruta
//Route::redirect('test', 'bikes', 301);

//Carrega directament la vista
//Route::view('test', 'welcome');