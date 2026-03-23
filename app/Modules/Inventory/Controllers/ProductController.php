<?php

namespace App\Modules\Inventory\Controllers;

use App\Modules\Inventory\Models\Inventory;
use App\Modules\Inventory\Models\Product;
use App\Modules\Inventory\Requests\StoreProductRequest; // Inyecta el FormRequest
use App\Http\Controllers\Controller;
use App\Modules\Inventory\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Despliega una lista de los recursos.
     */
    public function index()
    {
        $product = Product::all();
        return response()->json($product);
        // return Product::with(['family', 'unidadMedida', 'productUnit', 'inventory'])->get();
    }

    /**
     * Almacena un nuevo recurso creado en la base de datos.
     */
    public function store(StoreProductRequest $request)
    {
        // Valida los datos del request.
        $data = $request->validated();
        
        // Inserta el producto en la base de datos. Después de 
        // insertar, la base de datos devuelve el ID generado (ej: 6). 
        // Laravel automáticamente asigna ese valor a $product->id.
        $product = Product::create($data); 
        
        // Inserta el producto en la tabla inventario.
        Inventory::create([
            'producto_id' => $product->id, 
            'existencia_actual' => 0 // Inserta la existencia actual
        ]);

        // return response()->json($product, 201);
        return response()->json(
            [
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
