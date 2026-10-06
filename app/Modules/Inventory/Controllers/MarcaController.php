<?php

namespace App\Modules\Inventory\Controllers;

use App\Modules\Inventory\Services\MarcaService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Modules\Inventory\Requests\StoreMarcaRequest;
use App\Modules\Inventory\Requests\UpdateMarcaRequest;

/**
 * @author Francisco Cuevas
 * @description Controlador para las marcas.
 * Las marcas son importantes para la clasificación de los productos,
 * ya que permite agruparlos por marca, lo que facilita su administración.
 * @category Inventory
 * @package App\Modules\Inventory\Controllers
 */
class MarcaController extends Controller
{
    /**
     * @var MarcaService
     */
    protected $service;

    /**
     * @description Inyecta la dependencia del servicio.
     * @param MarcaService $service
     */
    public function __construct(MarcaService $service)
    {
        $this->service = $service;
    }
    /**
     * @description Lista todas las marcas.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->service->getAllMarcas();
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    

    /**
     * @description Crea una nueva marca.
     * @param StoreMarcaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreMarcaRequest $request)
    {
        Log::info('Ingreso a la funcion store de MarcaController');
        Log::info('Request: ' . json_encode($request->all(), JSON_PRETTY_PRINT));

        $data = $this->service->createMarca($request->validated());

        Log::info('Sale de la funcion store de MarcaController');
        Log::info('Response: ' . json_encode($data, JSON_PRETTY_PRINT));

        return response()->json([
            'success' => true,
            'message' => 'Marca creada correctamente',
            'data' => $data
        ], 201);
    }

    /**
     * @description Obtiene una marca por su ID.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->service->getMarcaById($id);
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    
    /**
     * @description Actualiza una marca.
     * @param int $id
     * @param UpdateMarcaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateMarcaRequest $request)
    {
        Log::info('Ingreso a la funcion update de MarcaController');
        Log::info('Data: ' . json_encode($request->all(), JSON_PRETTY_PRINT));

        $data = $this->service->updateMarca($id, $request->validated());

        Log::info('Sale de la funcion update de MarcaController');
        Log::info('Response: ' . json_encode($data, JSON_PRETTY_PRINT));

        return response()->json([
            'success' => true,
            'message' => 'Marca actualizada correctamente',
            'data' => $data
        ], 200);
    }

    /**
     * @description Elimina una marca.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $data = $this->service->deleteMarca($id);
        return response()->json([
            'success' => true,
            'message' => 'Marca eliminada correctamente',
            'data' => $data
        ], 200);
    }
}
