<?php

namespace App\Modules\Inventory\Controllers;

use App\Modules\Inventory\Models\Inventory;
use App\Modules\Inventory\Models\Product;
use App\Modules\Inventory\Models\ProductFamily;
use App\Modules\Inventory\Models\ProductUnit;
use App\Modules\Inventory\Models\UnidadMedida;
use App\Modules\Inventory\Requests\StoreProductRequest;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return response()->json($product);
        //return Product::with(['family', 'unidadMedida', 'productUnit', 'inventory'])->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    //public function create()
    //{
        //
    //}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //$product = Product::create($request->validated());
        //Inventory::create([
        //    'product_id' => $product->id,
        //    'existencia_actual' => 0,
        //]);
        //return response()->json([
        //    'message' => 'Producto creado exitosamente',
        //    'product' => $product,
        //], 201);

        
        $data = $request->validated(); // Valida los datos del request
        
        // Inserta el producto en la base de datos. Después de 
        // insertar, la base de datos devuelve el ID generado (ej: 6). 
        //Laravel automáticamente asigna ese valor a $product->id.
        $product = Product::create($data); 
        
        // Inserta el producto en la tabla inventario
        Inventory::create([
            'producto_id' => $product->id, 
            'existencia_actual' => 0 // Inserta la existencia actual
        ]);

        //return response()->json($product, 201);
        return response()->json(
            [
                'message' => 'Producto creado exitosamente',
                'product' => $product
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    //public function show(string $id)
    //{
        //
    //}

    /**
     * Show the form for editing the specified resource.
     */
    //public function edit(string $id)
    //{
        //
    //}

    /**
     * Update the specified resource in storage.
     */
    //public function update(Request $request, string $id)
    //{
        //
    //}

    /**
     * Remove the specified resource from storage.
     */
    //public function destroy(string $id)
    //{
        //
    //}

}
