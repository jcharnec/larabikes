<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactoController;
use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\User;
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
//grupo de rutas solamente para el administrador
//llevarán el prefijo 'admin'
Route::prefix('admin')->middleware('auth', 'is_admin')->group(function (){
    //ver las motos eliminadas (/admin/deletedbikes)
    Route::get('deletedbikes', [AdminController::class, 'deletedbikes'])
            ->name('admin.deleted.bikes');
    //detalles de un usuario
    Route::get('usuario/{user}/detalles', [AdminController::class, 'userShow'])
            ->name('admin.user.show');
    //listado de usuarios
    Route::get('usuarios', [AdminController::class, 'userList'])
            ->name('admin.users');
    //búsqueda de usuarios
    Route::get('usuario/buscar', [AdminController::class, 'userSearch'])
            ->name('admin.users.search');    
    // añadir un rol
    Route::post('role', [AdminController::class, 'setRole'])
            ->name('admin.user.setRole');
    //quitar un rol
    Route::delete('role', [AdminController::class, 'removeRole'])
            ->name('admin.user.removeRole');
});

Auth::routes(['verify' => true]);

//ruta de usuarios bloqueados
Route::get('/bloqueado', [UserController::class, 'blocked'])
    ->name('user.blocked');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// ruta para el formulario de contacto
Route::get('/contacto', [ContactoController::class, 'index'])
    ->name('contacto');

Route::post('/contacto', [ContactoController::class, 'send'])
    ->name('contacto.email');

// para buscar motos por marca y/o modelo
Route::match(['GET', 'POST'], 'bike/search', [BikeController::class, 'search'])
    ->name('bikes.search');
//->middleware('adult:13');


//restauración de la moto
Route::post('/bikes/{id}/restore', [BikeController::class, 'restore'])
        ->name('bikes.restore');

//eliminación definitiva de la moto
//va por DELETE por vario motivos:
// - coherencia con las operaciones del delete en Laravel
// - evitar los borrados accidentales
Route::delete('/bikes/purge', [BikeController::class, 'purge'])
        ->name('bikes.purge');

// CRUD de motos
Route::resource('bikes', BikeController::class);
//->middleware('adult:18');

// formulario de confirmación de eliminacion
Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])
    ->name('bikes.delete')
    ->middleware('throttle:8,1'); //max 3 peticiones por cada 1 min

//RUTA DE FALLBACK, ruta a la que irá si no coinciden las demás rutas.
Route::fallback([WelcomeController::class, 'index']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
