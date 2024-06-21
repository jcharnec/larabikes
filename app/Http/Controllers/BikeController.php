<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\View;

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
            'matriculada' => 'sometimes'
        ]);

        //creación y guardado de la nueva moto con todos los datos POST
        $bike = Bike::create($request->all());

        //redirección a los detalles de la moto creada
        return redirect()->route('bikes.show', $bike->id)
            ->with('success', "Moto $bike->marca $bike->modelo añadida satisfactoriamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // recupera la moto con el id deseado
        //si no la encuentra generará un error 404
        $bike = Bike::findOrFail($id);

        //carga la vista correspondiente y le pasa la moto
        return view('bikes.show', ['bike' => $bike]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // recupera la moto con el id deseado
        //si no la encuentra generará un error 404
        $bike = Bike::findOrFail($id);

        //carga la vista correspondiente y le pasa la moto
        return view('bikes.update')->with('bike', $bike);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $bike->update($request->all()+['matriculada' => 0]); //actualiza

        // carga la misma vista y muestra el mensaje de éxito
        return back()->with('success', "Moto $bike->marca $bike->modelo actualizada");
    }

    /**
     * Muestra el formulario de confirmación de borrado de la moto
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        //recupera la moto a eliminar
        $bike = Bike::findOrFail($id);

        // muestra la vista de confirmación de eliminación
        return view('bikes.delete',['bike'=>$bike]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // busca la moto seleccionada
        $bike = Bike::findOrFail($id);

        // la borra de la base de datos
        $bike->delete();

        //redirige a la lista de motos
        return redirect('bikes')
            ->with('success', "Moto $bike->marca $bike->modelo eliminada");
    }

}
