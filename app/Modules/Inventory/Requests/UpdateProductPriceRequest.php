<?php

namespace App\Modules\Inventory\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Modules\Inventory\Models\UnidadMedida;

/**
 * Request de validación para actualizar un precio por 
 * unidad de medida de un producto.
 */
class UpdateProductPriceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'producto_id.required' => 'El producto es requerido',
            'producto_id.exists' => 'El producto no existe',
            'unidad_medida_id.required' => 'La unidad de medida es requerida',
            'unidad_medida_id.exists' => 'La unidad de medida no existe',
            'precio_compra.required' => 'El precio de compra es requerido',
            'precio_compra.numeric' => 'El precio de compra debe ser un número',
            'precio_compra.min' => 'El precio de compra debe ser mayor o igual a 0',
            'precio_venta.required' => 'El precio de venta es requerido',
            'precio_venta.numeric' => 'El precio de venta debe ser un número',
            'precio_venta.min' => 'El precio de venta debe ser mayor o igual a 0',
        ];
    }
}