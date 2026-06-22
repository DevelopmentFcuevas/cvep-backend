<?php

namespace App\Modules\Inventory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Inventory\Models\ProductFamily;
use App\Modules\Inventory\Requests\StoreProductFamilyRequest;
use App\Modules\Inventory\Services\ProductFamilyService;

class ProductFamilyController extends Controller
{
    /**
     * @var ProductFamilyService
     */
    protected $service;

    /**
     * @description Inyecta la dependencia del servicio.
     * @param ProductFamilyService $service
     */
    public function __construct(ProductFamilyService $service)
    {
        $this->service = $service;
    }

    /**
     * @description Lista todas las familias de productos.
     * @return \Illuminate\Database\Eloquent\Collection<int, ProductFamily>
     */
    //public function index()
    //{
    //    return ProductFamily::all();
    //}
    /**
     * @description Lista todas las familias de productos.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->service->getAllProductFamilies();

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
    
    /**
     * @description Crea una nueva familia de productos.
     * @param StoreProductFamilyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    //public function store(StoreProductFamilyRequest $request)
    //{
    //    $productFamily = ProductFamily::create($request->all());
    //    return response()->json($productFamily, 201);
    //}
    /**
     * @description Crea una nueva familia de productos.
     * @param StoreProductFamilyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductFamilyRequest $request)
    {
        $productFamily = $this->service->createProductFamily($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Producto Familia creado correctamente',
            'data' => $productFamily
        ], 201);
    }

}