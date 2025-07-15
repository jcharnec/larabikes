<?php

namespace App\Http\Controllers;

use App\Events\FirstBikeCreated;
use App\Http\Requests\BikeDeleteRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\User;
use App\Http\Requests\BikeRequest;
use App\Http\Requests\BikeUpdateRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;


class BikeController extends Controller
{
    //constructor
    public function __construct()
    {
        //ponemos el middleware auth a todos los métodos excepto:
        // - lista de motos
        // --detalles de moto
        // - búsqueda de motos
        $this->middleware(['verified'])->except('index', 'show', 'search');

        // el método para eliminar una moto requiere confirmación de clave
        $this->middleware('password.confirm')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recuperar todas las motos
        $bikes = Bike::orderBy('id', 'DESC')->paginate(10);

        //caargar la vista con el listado de motos
        return view('bikes.list', ['bikes' => $bikes]);
    }

    /**
     * Function search
     *
     * @param mixed $name
     *
     */
    public function search(Request $request, $marca = null, $modelo = null)
    {

        //toma los valores que llegan para marca y modelo
        //pueden llegar vía URL o vía query string
        //por defecto les asignaremos ''
        $marca = $marca ?? $request->input('marca', '');
        $modelo = $modelo ?? $request->input('modelo', '');

        //recupera los resultados, se añade marca y modelo al paginador
        //para que mantenga el filtro al pasar página
        $bikes = Bike::where('marca', 'LIKE', '%' . $marca . '%')
            ->where('modelo', 'LIKE', "%$modelo%")
            ->paginate(config('paginator.bikes', 5))
            ->appends(['marca' => $marca, 'modelo' => $modelo]);

        return view('bikes.list', [
            'bikes' => $bikes,
            'marca' => $marca,
            'modelo' => $modelo
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mostrar el formulario
        return view('bikes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BikeRequest $request)
    {

        // recuperar datos del forumlario excepto la imagen
        $datos = $request->only([
            'marca',
            'modelo',
            'precio',
            'kms',
            'matriculada',
            'user_id',
            'matricula',
            'color'
        ]);

        // ✅ Verificar si existe esa matrícula (incluso eliminada)
        $existe = Bike::withTrashed()->where('matricula', $datos['matricula'])->exists();

        if ($existe) {
            return back()
                ->withInput()
                ->withErrors(['matricula' => 'Ya existe una moto con esta matrícula, incluso aunque esté eliminada.']);
        }

        //el valor por defecto para la imagen será NULL
        $datos += ['imagen' => NULL];

        //recuperación de la imagen
        if ($request->hasFile('imagen')) {
            //sube la imagen al directorio indicando en el fichero de config
            $ruta = $request->file('imagen')->store(config('filesystems.bikesImageDir'));

            //nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }

        // recupera el id del usuario identificado y lo guarda en user_id de la moto
        $datos['user_id'] = auth()->user()->id;

        //creación y guardado de la nueva moto con todos los datos POST
        $bike = Bike::create($datos);

        // si es la primera moto que crea el usuario...
        // (para hacerlo bien, se debería hacer con un campo de la BDD, puesto que así
        //cada vez que borre y cree la primera se despachará el evento)
        if ($request->user()->bikes->count() == 1)
            FirstBikeCreated::dispatch($bike, $request->user());

        //redirección a los detalles de la moto creada
        return redirect()
            ->route('bikes.show', $bike->id)
            ->with('success', "Moto $bike->marca $bike->modelo añadida satisfactoriamente")
            ->cookie('lastInsertID', $bike->id, 0);
    }

    /**
     * Display the specified resource.
     *
     * @param  Bike
     * @return \Illuminate\Http\Response
     */
    public function show(Bike $bike)
    {
        //carga la vista correspondiente y le pasa la moto
        return view('bikes.show', ['bike' => $bike]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Bike
     * @return \Illuminate\Http\Response
     */
    public function edit(BikeUpdateRequest $request, Bike $bike)
    {
        //carga la vista correspondiente y le pasa la moto
        return view('bikes.update')->with('bike', $bike);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Bike
     * @return \Illuminate\Http\Response
     */
    public function update(BikeUpdateRequest $request, Bike $bike)
    {
        // toma los datos del formulario
        $datos = $request->only('marca', 'modelo', 'kms', 'precio', 'user_id');

        //estos datos no se pueden tomar directamente
        $datos['matriculada'] = $request->has('matriculada') ? 1 : 0;
        $datos['matricula'] = $request->has('matriculada') ? $request->input('matricula') : NULL;
        $datos['color'] = $request->input('color') ?? NULL;

        // mira si llega el chekbox y pone 1 o 0 dependiendo de si llega o no
        $datos += $request->has('matriculada') ? ['matriculada' => 1] : ['matriculada' => 0];

        // si llega una nueva imagen..
        if ($request->hasFile('imagen')) {
            // marca la imagen antigua para ser borrada si el update va bien
            if ($bike->imagen)
                $aBorrar = config('filesystems.bikesImageDir') . '/' . $bike->imagen;

            // sube la imagen al directorio indicado en el fichero de config
            $imagenNueva = $request->file('imagen')->store(config('filesystems.bikesImageDir'));

            // nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen'] = pathinfo($imagenNueva, PATHINFO_BASENAME);
        }

        // en caso de que nos pidan eliminar la imagen
        if ($request->filled('eliminarimagen') && $bike->imagen) {
            $datos['imagen'] = NULL;
            $aBorrar = config('filesystems.bikesImageDir') . '/' . $bike->imagen;
        }

        // al actualizar debemos tener en cuenta varias cosas
        if ($bike->update($datos)) {
            if (isset($aBorrar))
                Storage::delete($aBorrar);
        } else {
            if (isset($imagenNueva))
                Storage::delete($imagenNueva);
        }

        //encola las cookies
        Cookie::queue('lastUpdateID', $bike->id, 0);
        Cookie::queue('lastUpdateDate', now(), 0);
        Cookie::queue('lastUpdate', 'Moto actualizada', 0);

        // carga la misma vista y muestra el mensaje de éxito
        return back()
            ->with('success', "Moto $bike->marca $bike->modelo actualizada");
        //->cookie('lastUpdateID', $bike->id,0);
    }

    /**
     * Muestra el formulario de confirmación de borrado de la moto
     *
     * @param Bike
     * @return \Illuminate\Http\Response
     */    public function delete(BikeDeleteRequest $request, Bike $bike)
    {
        // Recuerda la URL anterior para futuras redirecciones
        Session::put('returnTo', URL::previous());
        // Muestra la vista de confirmación de eliminación
        return view('bikes.delete', ['bike' => $bike]);
    }

    /**
     * Elimina la moto (soft delete)
     *
     * @param  Bike
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bike $bike)
    {
        $bike->delete(); // Soft delete (no podemos borrar la imagen aún)

        // Comprobamos si hay que retornar a algún sitio concreto
        // en caso contrario iremos a la lista de motos (ruta por defecto)
        $redirect = Session::has('returnTo') ?
            redirect(Session::get('returnTo')) :    // por URL
            redirect()->route('bikes.index');       // por nombre de ruta

        // Usaremos la URL por si hay parámetros adicionales a tener en cuenta
        // por ejemplo con la paginación va el número de página y si usamos el nombre
        // iremos al inicio de la lista y no a la página actual
        Session::forget('returnTo'); // Borramos la var de sesión si la hubiera

        // Redirige a la lista de motos
        return $redirect->with('success', "Moto $bike->marca $bike->modelo eliminada.");
    }

    public function restore(Request $request, int $id)
    {
        // Recuperar la moto borrada
        $bike = Bike::withTrashed()->findOrFail($id);

        // Verificar permisos usando la política de restauración
        if ($request->user()->cant('restore', $bike)) {
            throw new AuthorizationException('No tienes permiso');
        }

        // Restaurar la moto
        $bike->restore();

        // Redirigir a la página anterior con un mensaje de éxito
        return back()->with('success', "Moto $bike->marca $bike->modelo restaurada correctamente.");
    }

    public function purge(Request $request)
    {
        //recuperar la moto borrada
        $bike = Bike::withTrashed()->findOrFail($request->input('bike_id'));

        //comprobar los permisos mediante la policy
        if ($request->user()->cant('delete', $bike))
            throw new AuthorizationException('No tienes permiso');

        // si se consigue eliminar definitivamente la moto y ésta tiene foto...
        if ($bike->forceDelete() && $bike->imagen)
            // ... se elimina el fichero
            Storage::delete(config('filesystems.bikesImageDir') . '/' . $bike->imagen);

        return back()->with(
            'success',
            "Moto $bike->marca $bike->modelo eliminada definitivamente."
        );
    }
}
