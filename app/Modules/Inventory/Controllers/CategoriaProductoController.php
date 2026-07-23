<?php

namespace App\Modules\Inventory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Inventory\Models\CategoriaProducto;
use App\Modules\Inventory\Requests\StoreCategoriaProductoRequest;
use App\Modules\Inventory\Services\CategoriaProductoService;

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
     * @description Lista todas las familias de productos.
     * @return \Illuminate\Database\Eloquent\Collection<int, CategoriaProducto>
     */
    //public function index()
    //{
    //    return CategoriaProducto::all();
    //}
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
     * @description Crea una nueva familia de productos.
     * @param StoreCategoriaProductoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    //public function store(StoreCategoriaProductoRequest $request)
    //{
    //    $productFamily = CategoriaProducto::create($request->all());
    //    return response()->json($productFamily, 201);
    //}
    /**
     * @description Crea una nueva familia de productos.
     * @param StoreCategoriaProductoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCategoriaProductoRequest $request)
    {
        $productFamily = $this->service->createProductCategory($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Producto Familia creado correctamente',
            'data' => $productFamily
        ], 201);

        //try {
        //    $productFamily = $this->service->createProductFamily($request->validated());
        //    return response()->json([
        //        'success' => true,
        //        'message' => 'Producto Familia creado correctamente',
        //        'data' => $productFamily
        //    ], 201);
        //} catch (\Exception $e) {
        //    // Log crítico
        //    logger()->error('Error creando familia de producto', [
        //        'error' => $e->getMessage(),
        //        'data' => $request->all()
        //    ]);

        //    return response()->json([
        //        'success' => false,
        //        'message' => 'No se pudo crear la categoría de producto. Intenta de nuevo más tarde.',
        //        'error' => $e->getMessage()
        //    ], 500);
        //}

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
     * @param StoreCategoriaProductoRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreCategoriaProductoRequest $request, $id)
    {
        $data = $this->service->updateProductCategory($id, $request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Categoría de producto actualizada correctamente',
            'data' => $data
        ], 200);
    }
}
