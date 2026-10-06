<?php
namespace App\Modules\Public\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaisRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:100',
            'nacionalidad' => 'string|max:100',
            'cod_iso_2' => 'string|max:2',
            'cod_iso_3' => 'string|max:3',
            'prefijo_telefonico' => 'string|max:10',
            'estado' => 'string|max:10',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres',
            'nombre.max' => 'El nombre debe tener como máximo 100 caracteres',
            'nacionalidad.string' => 'La nacionalidad debe ser una cadena de caracteres',
            'nacionalidad.max' => 'La nacionalidad debe tener como máximo 100 caracteres',
            'cod_iso_2.string' => 'El código ISO 2 debe ser una cadena de caracteres',
            'cod_iso_2.max' => 'El código ISO 2 debe tener como máximo 2 caracteres',
            'cod_iso_3.string' => 'El código ISO 3 debe ser una cadena de caracteres',
            'cod_iso_3.max' => 'El código ISO 3 debe tener como máximo 3 caracteres',
            'prefijo_telefonico.string' => 'El prefijo telefónico debe ser una cadena de caracteres',
            'prefijo_telefonico.max' => 'El prefijo telefónico debe tener como máximo 10 caracteres',
            'estado.string' => 'El estado debe ser una cadena de caracteres',
            'estado.max' => 'El estado debe tener como máximo 10 caracteres',
        ];
    }
}