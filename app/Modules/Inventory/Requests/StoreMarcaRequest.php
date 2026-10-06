<?php

namespace App\Modules\Inventory\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

/**
 * Request de validacion para la creacion de marcas.
 * @category Inventory
 * @package App\Modules\Inventory\Requests
 */
class StoreMarcaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @description Reglas de validacion.
     * @return array
     * unique: inventory.marcas,nombre -> significa que la columna nombre debe ser unica en la tabla inventory.marcas
     * whereNull('deleted_at') -> significa que solo se tome en cuenta los registros que no han sido eliminados suavemente
     * en caso de que el registro sea restaurado se tomara en cuenta
     * 
     */
    public function rules(): array
    {
        return [
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('inventory.marcas', 'nombre')->whereNull('deleted_at'),
            ],
            'descripcion' => 'nullable|string|max:5000',
            'abreviatura' => 'nullable|string|max:20',
            'estado' => 'nullable|string|in:ACTIVO,INACTIVO',
        ];
    }

    /**
     * @description Mensajes de error.
     * @return array
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es requerido.',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El nombre debe tener como máximo 255 caracteres.',
            'nombre.unique' => 'El nombre ya existe.',
            'descripcion.string' => 'La descripción debe ser una cadena de caracteres.',
            'descripcion.max' => 'La descripción debe tener como máximo 5000 caracteres.',
            'abreviatura.string' => 'La abreviatura debe ser una cadena de caracteres.',
            'abreviatura.max' => 'La abreviatura debe tener como máximo 20 caracteres.',
            'estado.string' => 'El estado debe ser una cadena de caracteres.',
            'estado.in' => 'El estado debe ser ACTIVO o INACTIVO.',
        ];
    }
}
