<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recuperar todas las motos
        //$bikes = Bike::orderBy('id', 'DESC')
        //    ->paginate(config('paginator.bikes', 10));
        $bikes = Bike::orderBy('id', 'DESC')->paginate(10);
        // total de motos en la BDD(para mostrar)
        //$total = Bike::count();

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
    public function store(Request $request)
    {
        //validación de datos de entrada mediante validator
        $request->validate([
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            'precio' => 'required|numeric',
            'kms' => 'required|integer',
            'matriculada' => 'sometimes',
            'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048'
        ]);

        // recuperar datos del forumlario excepto la imagen
        $datos = $request->only(['marca', 'modelo', 'precio', 'kms', 'matriculada']);

        //el valor por defecto para la imagen será NULL
        $datos += ['imagen' => NULL];

        //recuperación de la imagen
        if ($request->hasFile('imagen')) {
            //sube la imagen al directorio indicando en el fichero de config
            $ruta = $request->file('imagen')->store(config('filesystems.bikesImageDir'));

            //nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }

        //creación y guardado de la nueva moto con todos los datos POST
        $bike = Bike::create($datos);

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
    /*
    public function show($id)
    {
        // recupera la moto con el id deseado
        //si no la encuentra generará un error 404
        $bike = Bike::findOrFail($id);

        //carga la vista correspondiente y le pasa la moto
        return view('bikes.show', ['bike' => $bike]);
    }*/

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
    /*
    public function edit($id)
    {
        // recupera la moto con el id deseado
        //si no la encuentra generará un error 404
        $bike = Bike::findOrFail($id);

        //carga la vista correspondiente y le pasa la moto
        return view('bikes.update')->with('bike', $bike);
    }*/
    public function edit(Bike $bike)
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
    /*
    public function update(Request $request, $id)
    {
        // validación de datos
        $request->validate([
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            'precio' => 'required|numeric',
            'kms' => 'required|integer',
            'matriculada' => 'sometimes',
        ]);

        $bike = Bike::findOrFail($id); //recupera la moto de la BDD
        $bike->update($request->all() + ['matriculada' => 0]); //actualiza

        // carga la misma vista y muestra el mensaje de éxito
        return back()->with('success', "Moto $bike->marca $bike->modelo actualizada");
    }*/
    public function update(Request $request, Bike $bike)
    {
        // validación de datos
        $request->validate([
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            'precio' => 'required|numeric',
            'kms' => 'required|integer',
            'matriculada' => 'sometimes',
            'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:4096'
        ]);
        
        // toma los datos del formulario
        $datos = $request->only('marca', 'modelo', 'kms', 'precio');

        // mira si llega el chekbox y pone 1 o 0 dependiendo de si llega o no
        $datos += $request->has('matriculada') ? ['matriculada'=>1] : ['matriculada'=>0];

        // si llega una nueva imagen..
        if ($request->hasFile('imagen')) {
            // marca la imagen antigua para ser borrada si el update va bien
            if($bike->imagen)
                $aBorrar = config('filesystems.bikesImageDir').'/'.$bike->imagen;

            // sube la imagen al directorio indicado en el fichero de config
            $imagenNueva = $request->file('imagen')->store(config('filesystems.bikesImageDir'));

            // nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen'] = pathinfo($imagenNueva, PATHINFO_BASENAME);
        }
        
        // en caso de que nos pidan eliminar la imagen
        if ($request->filled('eliminarimagen') && $bike->imagen){
            $datos['imagen'] = NULL;
            $aBorrar = config('filesystems.bikesImageDir').'/'.$bike->imagen;
        }

        // al actualizar debemos tener en cuenta varias cosas
        if ($bike->update($datos)){
            if(isset($aBorrar))
                Storage::delete($aBorrar);
        }else{
            if(isset($imagenNueva))
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
     */
    public function delete(Bike $bike)
    {
        // muestra la vista de confirmación de eliminación
        return view('bikes.delete', ['bike' => $bike]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Bike
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bike $bike)
    {
        // comprobar la validez de la firma de la URL
        if (!$request->hasValidSignature())
            abort(401, 'La firma de la URL no se pudo validar');

        // la borra de la base de datos
        if ($bike->delete() && $bike->imagen)
            //elimina el fichero
            Storage::delete(config('filesystems.bikesImageDir') . '/' . $bike->imagen);

        //redirige a la lista de motos
        return redirect('bikes')
            ->with('success', "Moto $bike->marca $bike->modelo eliminada");
    }
}
