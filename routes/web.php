<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactoController;
use Illuminate\Http\Request;
use App\Models\Bike;

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

// ruta para el formulario de contacto
Route::get('/contacto', [ContactoController::class, 'index'])
    ->name('contacto');

Route::post('/contacto', [ContactoController::class, 'send'])
    ->name('contacto.email');

// para buscar motos por marca y/o modelo
Route::match(['GET', 'POST'], 'bike/search', [BikeController::class, 'search'])
    ->name('bikes.search');
//->middleware('adult:13');

// CRUD de motos
Route::resource('bikes', BikeController::class);
//->middleware('adult:18');

// formulario de confirmación de eliminacion
Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])
    ->name('bikes.delete')
    ->middleware('throttle:3,1'); //max 3 peticiones por cada 1 min
//->middleware('adult:21');



//RUTA DE FALLBACK, ruta a la que irá si no coinciden las demás rutas.
Route::fallback([WelcomeController::class, 'index']);
/*
// ruta de test
Route::get('/test', function(){
    Log::info("Tienes un nuevo mensaje :D");

    return "Consulta el fichero de log.";
});*/

//ZONA PARA PRUEBAS (borrar al finalizar)
Route::get('saludar', function () {
    return 'Hola mundo :D';
});

/*Route::match(['PUt', 'DELETE'], 'test', function(Request $request){
    return 'Estás haciendo la prueba por '.$request->getMethod();
});*/


//Route::redirect('test', 'bikes', 301);


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
/*
// ruta con dos párametros variables
Route::get('test/{nombre}/{edad}', function($nombre, $edad){
    return "Hola $nombre, tienes $edad años.";
});

// ruta con un párametro variable
Route::get('test/{nombre}', function($nombre){
    return "Hola $nombre, bienvenido al curso.";
});*/

// importante no solapar las rutas, si tenemos dos rutas iguales y una usa id, este
// no es considerado númerico a no ser que se indique explicitamente con id:int, en ese
//caso si la ruta id es primera, al poner cualquier cosa, o create entraria en la de id
// por ese motivo si queremos crear una moto y que entre por esa ruta, create irá primero
// para que no exista un solapamiento.
/*Route::get('test/{id:int}', function ($id){
    return "Intenta visualizar la moto $id.";
});*/
/*
Route::get('test/create', function(){
    return "Intentas crear una nueva moto.";
});

Route::get('test/{id}', function ($id){
    return "Intenta visualizar la moto $id.";
});*/

/*
// ruta con dos parámetros opcionales, hay que tener en cuenta que no encontraria solo con search
//ya que tenemos el resource encima y coincidiria con otro bikes/{id}
Route::get(
    'bikes/search/{marca?}/{modelo?}',
    function($marca = '', $modelo = ''){

        // busca las motos con esa marca y modelo
        $bikes = Bike::where ('marca', 'like', '%'.$marca.'%')
            ->where('modelo', 'like', '%'.$modelo.'%')
            ->paginate(config('pagination.bikes'));
        
        return view('bikes.list', ['bikes' => $bikes]);
        }
    );*/


/*
// Usando expresiones regulares
Route::get('test/{id}', function($id){
    return "Has accedido por la primera ruta.";
    })->where('id', '^\d{1,11}$'); // de 1 a 11 dígitos

Route::get('test/{dni}', function($dni){
    return "Has accedido por la segunda ruta.";
    })->where('dni', '^[\dXYZ]\d{7}[A-Z]$'); //DNI

Route::get('test/{otro}', function($otro){
    return "$otro no es número ni un DNI.";
    });
*/

// personalizando la lógica
Route::get('bikes/chollos/{precio}', function ($precio) {
    // precio contendrá una lista de motos de precio
    //inferior o igual al recibido por parámetro
    //la lógica s eencuentra en el proveedor de servicios RouteServiceProvider

    return view('bikes.list', ['bikes' => $precio]);
});

//prefijos para agrupar middleware
Route::prefix('admin')->group(function () {
    // he definido las rutas de la prueba con clausaras, evidentemente
    //podría haber indicado controlador y método
    Route::get('bikes', function () {
        return "Estás en admin/bikes, método GET";
    });
    Route::post('bikes', function () {
        return "Estás en admin/bikes, método POST";
    });
    Route::put('bikes', function () {
        return "Estás en admin/bikes, método PUT";
    });
    Route::delete('bikes', function () {
        return "Estás en admin/bikes, método DELETE";
    });
});
/*
Route::get('test', function(){
    //retorna un array que convertirá en un Response JSON completa
    return[
        'nombre' => 'Juan',
        'apellido' => 'Pérez',
        'edad' => NULL,
        'vehiculo' => 'bicicleta',
        'dorsal' => 32
    ];
});*/

Route::get('\bikes', function () {
    // retorna la lista completa de motos
    return Bike::all();
});

/*
Route::get('test', function(){
    //retorna un array que convertirá en un Response JSON completa
    return response('Esta es una respuesta completa', 200);
});*/

/*
Route::get('test', function(){
    //retorna una respuesta de texto, con código 200
    //y con múltiples encabezados
    return response('Anexando headers', 200)
        ->withHeaders([
            'Content-type' => 'text/plain',
            'From' => 'Robert Sallent',
            'Place' => 'CIFO Sabadell',
            'Year' => '2022'
        ]);
});*/

/*
Route::get('test', function(){
    //retorna una respuesta sin contenido
    return response()->noContent(200);
});*/

/*
Route::get('test', function(){
    //equivale a return view('welcome')
    return response()->view('welcome');
});*/

/*
// usaremos el implicit binding, he puesto el nombre plenamente
// cualificado para ahorrarme el "use"
Route::get('test/{bike}', function(Bike $bike){
    return response()->json($bike);
});*/

/*
Route::get('test', function(){
    return response()->download(
        public_path('images/bikes/bike0.png'),
        'akira.png'  
    );
});*/

/*
Route::get('test', function(){
    return response()->download(
        storage_path('app\docs\IFCD45.pdf'),
        'programa.pdf',
        ['Content-type' => 'application/pdf']
    );
});*/

/*
Route::get('test', function(){
    return response()->file(
        public_path('images/bikes/bike0.png'),
        ['Content-type' => 'image/png']
    );
});*/