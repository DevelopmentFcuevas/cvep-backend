<?php

namespace App\Modules\Inventory\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Request de validación para actualizar una unidad de medida.
 */
class UpdateUnidadMedidaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'nombre' => ['required', 'string', 'max:255', Rule::unique('inventory.unidad_medida', 'nombre')->ignore($id)],
            'descripcion' => 'nullable|string|max:255',
            'sigla' => ['nullable', 'string', 'max:10', Rule::unique('inventory.unidad_medida', 'sigla')->ignore($id)],
            'decimal' => 'nullable|integer',
            'estado' => 'nullable|string|in:ACTIVO,INACTIVO',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder los 255 caracteres.',
            'nombre.unique' => 'El nombre ya existe.',
            'descripcion.max' => 'La descripción no puede exceder los 255 caracteres.',
            'sigla.max' => 'La sigla no puede exceder los 10 caracteres.',
            'sigla.unique' => 'La sigla ya existe.',
            'decimal.integer' => 'El decimal debe ser un número entero.',
            'estado.in' => 'El estado debe ser ACTIVO o INACTIVO.',
        ];
    }
}
