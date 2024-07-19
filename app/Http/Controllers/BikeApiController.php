<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class BikeApiController extends Controller
{
    /**
     * Summary of index
     * método que recupera todas las motos y las retorna en JSON
     * @return array
     */
    public function index(){
        //recupera todas las motos ordenadas por ir DESC
        //par orden por defecto podemos usar Bike:all()
        $motos = Bike::orderBy('id', 'DESC')->get();

        return[
            'status' => 'OK',
            'total' => count($motos),
            'results' => $motos
        ];
    }

    /**
     * Summary of show
     * método que recupera una moto por id y la retorna en JSON
     * @param mixed $id
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show($id){
        // no usaremos un findOrFail ni un implicit binding puesto 
        // que queremos personalizar el error en caso de que se produzca
        $moto = Bike::find($id);

        return $moto ?
        [
            'status' => 'OK',
            'results' => [$moto]
        ]:
        response(['status' => 'NOT FOUND'], 404);
    }

    /**
     * Summary of search
     * método que busca motos y retorna JSON
     * @param mixed $campo
     * @param mixed $valor
     * @return array
     */
    public function search($campo = 'marca', $valor = ''){
        //recupera las motos con los criterios especificos
        $motos = Bike::where($campo, 'like', "%$valor%")->get();

        return [
            'status' => 'OK',
            'total' => count($motos),
            'results' => $motos
        ];
    }
}
