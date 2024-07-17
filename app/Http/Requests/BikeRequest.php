<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'marca' => 'required|max:255',
                'modelo' => 'required|max:255',
                'precio' => 'required|numeric|min:0',
                'kms' => 'required|integer|min:0',
                'matriculada' => 'required_with:matricula',
                'matricula' => ['required_if:matriculada,1|
                                nullable|
                                regex:/^\d{4}[B-Z]{3}$/i|
                                unique:bikes|
                                confirmed'],
                'color' => 'nullable|regex:/^#[\dA-F]{6}$/i',
                'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:4096'
        ];
    }

    public function messages(){
        return [
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
            'kms.numeric' => 'Los kilómetros deben ser un número entero.',
            'kms.min' => 'Los kilómetros deben ser mayor o igual a 0.',
            'matricula.required_if' => 'La mátricula es obligatoria si la moto está matriculada.',
            'matricula.unique' => 'Ya existe una moto con la misma matrícula.',
            'matricula.regex' => 'La matrícula debe tener 4 números y 3 letras.',
            'matricula.confirmed' => 'Las matrículas no coinciden.',
            'color.regex' => 'El color debe estar en formato RGB HEX comenzando por #.',
            'imagen.image' => 'El fichero debe ser una imagen',
            'imagen.mimes' => 'El archivo debe de ser tipo jpg, png, gif o webp.',
        ];
    }
}
