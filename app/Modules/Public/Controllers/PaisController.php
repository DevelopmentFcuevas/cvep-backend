<?php
namespace App\Modules\Public\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Public\Requests\StorePaisRequest;
use App\Modules\Public\Requests\UpdatePaisRequest;
use App\Modules\Public\Services\PaisService;
use Illuminate\Support\Facades\Log;

class PaisController extends Controller
{
    /**
     * @var PaisService
     */
    protected $service;

    /**
     * @description Inyecta la dependencia del servicio.
     * @param PaisService $service
     */
    public function __construct(PaisService $service)
    {
        $this->service = $service;
    }

    /**
     * @description Lista todas las paises.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->service->getAllPaises();

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * @description Crea un nuevo pais.
     * @param StorePaisRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePaisRequest $request)
    {
        Log::info('Ingreso a la funcion store de PaisController');
        Log::info('Request: ' . json_encode($request->all(), JSON_PRETTY_PRINT));

        $pais = $this->service->createPais($request->validated());
        Log::info('Sale de la funcion store de PaisController');
        return response()->json([
            'success' => true,
            'message' => 'País creado correctamente',
            'data' => $pais
        ], 201);
    }

    /**
     * @description Obtiene una pais por su ID.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->service->getPaisById($id);
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * @description Elimina una pais.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $data = $this->service->deletePais($id);
        return response()->json([
            'success' => true,
            'message' => 'País eliminado correctamente',
            'data' => $data
        ], 200);
    }

    /**
     * @description Actualiza una pais.
     * @param UpdatePaisRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePaisRequest $request, $id)
    {
        $data = $this->service->updatePais($id, $request->validated());
        return response()->json([
            'success' => true,
            'message' => 'País actualizado correctamente',
            'data' => $data
        ], 200);
    }
}   