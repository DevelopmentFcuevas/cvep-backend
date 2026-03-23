<?php

namespace App\Modules\People\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_razon_social' => 'required|string|max:255',
            //'ruc' => 'nullable|string|max:20|unique:people.persona,ruc',
            //'direccion' => 'required|string|max:255',
            //'ciudad' => 'required|string|max:255',
            //'descripcion_ubicacion' => 'required|string|max:255',
            'ruc' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'descripcion_ubicacion' => 'nullable|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'nombre_razon_social.required' => 'El nombre o razón social es obligatorio',
            //'ruc.unique' => 'El RUC ya está registrado'
            'ruc.required' => 'El RUC es obligatorio'
        ];
    }

}