<?php
namespace App\Modules\Public\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @author Francisco Cuevas
 * @description Request para la actualización de colores.
 * @category Public
 * @package App\Modules\Public\Requests
 */
class UpdateColorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'codigo_color' => 'nullable|string|max:30',
            'estado' => 'nullable|string|max:10',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre debe tener como máximo 255 caracteres.',
            'codigo_color.string' => 'El código del color debe ser una cadena de texto.',
            'codigo_color.max' => 'El código del color no puede exceder los 30 caracteres.',
            'estado.string' => 'El estado debe ser una cadena de texto.',
            'estado.max' => 'El estado no puede exceder los 10 caracteres.',
        ];
    }
}