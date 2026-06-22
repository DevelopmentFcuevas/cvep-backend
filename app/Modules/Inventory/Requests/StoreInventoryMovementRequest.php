<?php

namespace App\Modules\Inventory\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request de validación para crear un movimiento de inventario.
 */
class StoreInventoryMovementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tipo_movimiento' => 'required|in:ENTRADA,SALIDA,AJUSTE',
            'cantidad' => 'required|numeric|min:0',
            'motivo' => 'nullable|string|max:255',
        ];
    }
}