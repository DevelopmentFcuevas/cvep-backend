<?php

namespace App\Modules\Inventory\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Modules\Inventory\Models\CategoriaProducto;
use App\Modules\Inventory\Models\UnidadMedida;
use App\Modules\Inventory\Models\Marca;
use App\Modules\Public\Models\Pais;
use App\Modules\Public\Models\Color;

/**
 * Request de validación para crear un producto.
 */
class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Obtiene las reglas de validación del request.
     *
     * @return array<string, array<string, mixed>>
     */
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'marca_id' => ['required', Rule::exists(Marca::class, 'id')],
            'codigo_barras' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'modelo' => 'nullable|string',
            'serie' => 'nullable|string',
            'notas' => 'nullable|string',
            'peso' => 'nullable|decimal:2',
            'volumen' => 'nullable|decimal:2',
            'color_id' => ['nullable', Rule::exists(Color::class, 'id')],
            'pais_id' => ['required', Rule::exists(Pais::class, 'id')],
            'categoria_producto_id' => ['required', Rule::exists(CategoriaProducto::class, 'id')],
            'unidad_medida_id' => ['required', Rule::exists(UnidadMedida::class, 'id')]
        ];
    }

    /**
     * Obtiene los mensajes de error personalizados del request.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede exceder los 255 caracteres.',
            
            'marca_id.required' => 'La marca es requerida.',
            'marca_id.exists' => 'La marca seleccionada no existe.',

            'codigo_barras.string' => 'El código de barras debe ser una cadena de texto.',
            'codigo_barras.max' => 'El código de barras no puede exceder los 255 caracteres.',

            'descripcion.string' => 'La descripción debe ser una cadena de texto.',

            'modelo.string' => 'El modelo debe ser una cadena de texto.',

            'serie.string' => 'La serie debe ser una cadena de texto.',

            'notas.string' => 'Las notas deben ser una cadena de texto.',

            'peso.decimal' => 'El peso debe ser un número decimal.',

            'volumen.decimal' => 'El volumen debe ser un número decimal.',

            'color_id.exists' => 'El color seleccionado no existe.',

            'pais_id.required' => 'El país es requerido.',
            'pais_id.exists' => 'El país seleccionado no existe.',

            'categoria_producto_id.required' => 'La categoría de producto es requerida.',
            'categoria_producto_id.exists' => 'La categoría de producto seleccionada no existe.',

            'unidad_medida_id.required' => 'La unidad de medida es requerida.',
            'unidad_medida_id.exists' => 'La unidad de medida seleccionada no existe.',
        ];
    }
}