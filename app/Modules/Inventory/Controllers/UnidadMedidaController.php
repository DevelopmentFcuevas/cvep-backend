<?php

namespace App\Modules\Inventory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Inventory\Models\UnidadMedida;
use App\Modules\Inventory\Requests\UnidadMedidaRequest;

class UnidadMedidaController extends Controller
{
    public function index()
    {
        return UnidadMedida::all();
    }

    public function store(UnidadMedidaRequest $request)
    {
        $unidadMedida = UnidadMedida::create($request->all());
        return response()->json($unidadMedida, 201);
    }
}
