<?php

namespace App\Modules\Inventory\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Modules\Inventory\Models\ProductFamily;
use App\Modules\Inventory\Models\UnidadMedida;

/**
 * Request de validación para crear un producto.
 */
class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'marca' => 'nullable|string',
            'descripcion' => 'nullable|string',
            'color' => 'nullable|string',
            'pais_origen' => 'nullable|string',
            'porcentaje_iva' => 'required|integer',
            'familia_producto_id' => ['required', Rule::exists(ProductFamily::class, 'id')],
            'unidad_medida_id' => ['required', Rule::exists(UnidadMedida::class, 'id')]
        ];
    }

    public function messages()
    {
        return [
            'familia_producto_id.exists' => 'La familia de producto seleccionada no existe.',
            'unidad_medida_id.exists' => 'La unidad de medida seleccionada no existe.',
        ];
    }
}