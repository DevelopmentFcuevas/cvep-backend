<?php

namespace App\Modules\Inventory\Controllers;

use App\Modules\Inventory\Models\Inventory;
use App\Modules\Inventory\Models\Product;
use App\Modules\Inventory\Requests\StoreProductRequest; // Inyecta el FormRequest
use App\Http\Controllers\Controller;
use App\Modules\Inventory\Requests\UpdateProductRequest;
use App\Modules\Inventory\Services\ProductoService;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * @var ProductoService
     */
    protected $productService;

    /**
     * @description Inyecta la dependencia del servicio de productos.
     * @param ProductoService $productService
     */
    public function __construct(ProductoService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @description Valida si el producto existe en la base de datos.
     * @param int $id
     * @return Product|null
     */
    public function findProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }
        return $product;
    }

    /**
     * @description Lista todos los productos.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->productService->getAllProductos();
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * @description Almacena un nuevo producto.
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        Log::info('Ingreso a la funcion store de ProductController');
        Log::info('Request: ' . json_encode($request->all(), JSON_PRETTY_PRINT));
        
        // Valida los datos del request.
        $data = $request->validated();
        
        // Inserta el producto en la base de datos. Después de 
        // insertar, la base de datos devuelve el ID generado (ej: 6). 
        // Laravel automáticamente asigna ese valor a $product->id.
        //$product = Product::create($data); 
        $product = $this->productService->createProducto($data);
        
        // Inserta el producto en la tabla inventario.
        Inventory::create([
            'producto_id' => $product->id, 
            'existencia_actual' => 0 // Inserta la existencia actual
        ]);

        // return response()->json($product, 201);
        Log::info('Sale de la funcion store de ProductController');
        Log::info('Response: ' . json_encode($product, JSON_PRETTY_PRINT));

        return response()->json(
            [
                'success' => true,
                'message' => 'Producto creado exitosamente',
                'product' => $product
            ],
            201
        );
    }

    public function show($id)
    {
        // Busca el producto por ID.
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
    
    public function update(UpdateProductRequest $request, $id)
    {
        // Valida los datos del request.
        $data = $request->validated();
        
        // Busca el producto por ID.
        $product = Product::findOrFail($id);

        // Actualiza el producto en la base de datos.
        $product->update($data);
        
        // Actualiza el producto en la tabla inventario.
        //Inventory::where('producto_id', $id)->update([
        //    'existencia_actual' => $data['existencia_actual']
        //]);
        
        // return response()->json($product, 200);
        return response()->json(
            [
                'message' => 'Producto actualizado exitosamente',
                'product' => $product
            ],
            200
        );
    }

    public function destroy($id)
    {
        /*
        // Busca el producto por ID.
        $product = Product::findOrFail($id);

        // Elimina el producto de la base de datos.
        $product->delete();
        
        // return response()->json($product, 200);
        return response()->json(
            [
                'message' => 'Producto eliminado exitosamente'//,
                //'product' => $product
            ],
            200
        );
        */

        // Busca el producto por ID.
        $product = Product::findOrFail($id);

        // Si tiene precios asociados
        if ($product->unidadMedida()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar el producto porque tiene precios asociados.'
            ], 409);
        }

        // Si tiene inventario y stock mayor a 0
        if ($product->inventory()->exists() && $product->inventory->existencia_actual > 0) {
            return response()->json([
                'message' => 'No se puede eliminar el producto porque tiene stock disponible.'
            ], 409);
        }

        // Elimina el producto de la base de datos.
        $product->delete();
        
        // return response()->json($product, 200);
        return response()->json(
            [
                'message' => 'Producto eliminado exitosamente'//,
                //'product' => $product
            ],
            200
        );    
    }

}
