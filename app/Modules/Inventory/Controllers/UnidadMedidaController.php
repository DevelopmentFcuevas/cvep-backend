<?php

namespace App\Modules\Inventory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Inventory\Requests\StoreUnidadMedidaRequest;
use App\Modules\Inventory\Requests\UpdateUnidadMedidaRequest;
use App\Modules\Inventory\Services\UnidadMedidaService;

class UnidadMedidaController extends Controller
{
    /**
     * @var UnidadMedidaService
     */
    protected $service;

    /**
     * @description Constructor de la clase.
     * Inyecta el servicio de unidades de medida para su posterior uso.
     * @param \App\Modules\Inventory\Services\UnidadMedidaService $service
     */
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

    /**
     * @description Crea una nueva unidad de medida.
     * @param \App\Modules\Inventory\Requests\StoreUnidadMedidaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUnidadMedidaRequest $request)
    {
        $unitMeasure = $this->service->createUnitMeasure($request->validated());
        //Retorna un JSON con la unidad de medida creada.
        return response()->json([
            'success' => true,
            'message' => 'Unidad de medida creada correctamente',
            'data' => $unitMeasure
        ], 201);
    }

    /**
     * @description Actualiza una unidad de medida.
     * @param int $id
     * @param \App\Modules\Inventory\Requests\UpdateUnidadMedidaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateUnidadMedidaRequest $request)
    {
        $unitMeasure = $this->service->updateUnitMeasure($id, $request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Unidad de medida actualizada correctamente',
            'data' => $unitMeasure
        ], 200);
    }

    /**
     * @description Elimina una unidad de medida.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $unitMeasure = $this->service->deleteUnitMeasure($id);
        return response()->json([
            'success' => true,
            'message' => 'Unidad de medida eliminada correctamente',
            'data' => $unitMeasure
        ], 200);
    }

    /**
     * @description Muestra una unidad de medida.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $unitMeasure = $this->service->getUnitMeasureById($id);
        return response()->json([
            'success' => true,
            'message' => 'Unidad de medida obtenida correctamente',
            'data' => $unitMeasure
        ], 200);
    }
}
