<?php

namespace App\Modules\Inventory\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryMovementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //'producto_id' => 'required|exists:inventory.producto,id',
            'tipo_movimiento' => 'required|in:entrada,salida,ajuste',
            'cantidad' => 'required|numeric|min:0',
            'motivo' => 'nullable|string|max:255',
        ];
    }
}