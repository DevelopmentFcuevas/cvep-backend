<?php
namespace App\Modules\Public\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Public\Requests\StoreColorRequest;
use App\Modules\Public\Requests\UpdateColorRequest;
use App\Modules\Public\Services\ColorService;
use Illuminate\Support\Facades\Log;

class ColorController extends Controller
{
    /**
     * @var ColorService
     */
    protected $service;

    /**
     * @description Inyecta la dependencia del servicio.
     * @param ColorService $service
     */
    public function __construct(ColorService $service)
    {
        $this->service = $service;
    }

    /**
     * @description Lista todas los colores.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->service->getAllColores();

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * @description Crea un nuevo color.
     * @param StoreColorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreColorRequest $request)
    {
        Log::info('Ingreso a la funcion store de ColorController');
        Log::info('Request: ' . json_encode($request->all(), JSON_PRETTY_PRINT));

        $color = $this->service->createColor($request->validated());
        Log::info('Sale de la funcion store de ColorController');
        return response()->json([
            'success' => true,
            'message' => 'Color creado correctamente',
            'data' => $color
        ], 201);
    }

    /**
     * @description Obtiene un color por su ID.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->service->getColorById($id);
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * @description Elimina un color.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $data = $this->service->deleteColor($id);
        return response()->json([
            'success' => true,
            'message' => 'Color eliminado correctamente',
            'data' => $data
        ], 200);
    }

    /**
     * @description Actualiza un color.
     * @param UpdateColorRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateColorRequest $request, $id)
    {
        $data = $this->service->updateColor($id, $request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Color actualizado correctamente',
            'data' => $data
        ], 200);
    }
}   