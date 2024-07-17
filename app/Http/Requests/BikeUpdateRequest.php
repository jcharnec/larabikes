<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class BikeUpdateRequest extends BikeRequest
{
    // determina si el usuario está autorizado para realizar la petición
    public function authorize(){
        //retorna true solamente si el usuario tiene permiso para actualizar
        return $this->user()->can('update', $this->bike);
    }

    //mensaje en caso de que falle la autorización
    protected function failedAuthorization(){
        throw new AuthorizationException('No puedes editar una moto que no es tuya.');
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // si usamos implicit binding, se mapea automáticamente una instancia
        //del modelo a modo de propiedad de la request
        $id = $this->bike->id;
        // también podemos recuperarlo así: $id = $this->route('bike');

        //retorna la regla de matrícula modificada y las reglas del padre
        return [
            'matricula' => "required_if:matriculada,1|
                            nullable|
                            regex:/^\d{4}[B-Z]{3}$/i|
                            unique:bikes,matricula,$id",
        ]+parent::rules();
    }
}
