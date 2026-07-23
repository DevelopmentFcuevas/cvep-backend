<?php

namespace App\Modules\Inventory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Inventory\Models\UnidadMedida;
use App\Modules\Inventory\Requests\StoreUnidadMedidaRequest;
use App\Modules\Inventory\Services\UnidadMedidaService;

class UnidadMedidaController extends Controller
{
    protected $service;

    public function __construct(UnidadMedidaService $service)
    {
        $this->service = $service;
    }

    /**
     * @description Lista todas las unidades de medida.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->service->getAllUnitMeasures();
        
        //Retorna un JSON con las unidades de medida.
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function store(StoreUnidadMedidaRequest $request)
    {
        //$unidadMedida = UnidadMedida::create($request->all());
        return response()->json($unidadMedida, 201);
    }
}
