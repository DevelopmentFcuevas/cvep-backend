<?php

namespace App\Modules\Inventory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Inventory\Requests\StoreCategoriaProductoRequest;
use App\Modules\Inventory\Requests\UpdateCategoriaProductoRequest;
use App\Modules\Inventory\Services\CategoriaProductoService;
use Illuminate\Support\Facades\Log;

class CategoriaProductoController extends Controller
{
    /**
     * @var CategoriaProductoService
     */
    protected $service;

    /**
     * @description Inyecta la dependencia del servicio.
     * @param CategoriaProductoService $service
     */
    public function __construct(CategoriaProductoService $service)
    {
        $this->service = $service;
    }

    /**
     * @description Lista todas las categorías de productos.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->service->getAllProductCategories();

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    
    /**
     * @description Crea una nueva categoria de productos.
     * @param StoreCategoriaProductoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCategoriaProductoRequest $request)
    {
        Log::info('Ingreso a la funcion store de CategoriaProductoController');
        Log::info('Request: ' . json_encode($request->all(), JSON_PRETTY_PRINT));

        $productFamily = $this->service->createProductCategory($request->validated());
        Log::info('Sale de la funcion store de CategoriaProductoController');
        return response()->json([
            'success' => true,
            'message' => 'Categoría de producto creada correctamente',
            'data' => $productFamily
        ], 201);
    }

    /**
     * @description Obtiene una categoría de producto por su ID.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->service->getProductCategoryById($id);
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * @description Elimina una categoría de producto.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $data = $this->service->deleteProductCategory($id);
        return response()->json([
            'success' => true,
            'message' => 'Categoría de producto eliminada correctamente',
            'data' => $data
        ], 200);
    }

    /**
     * @description Actualiza una categoría de producto.
     * @param UpdateCategoriaProductoRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoriaProductoRequest $request, $id)
    {
        $data = $this->service->updateProductCategory($id, $request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Categoría de producto actualizada correctamente',
            'data' => $data
        ], 200);
    }
}
