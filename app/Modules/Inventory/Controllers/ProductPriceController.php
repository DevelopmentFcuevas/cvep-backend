<?php
namespace App\Modules\Inventory\Controllers;

use App\Modules\Inventory\Models\ProductUdM;
use App\Modules\Inventory\Requests\StoreProductPriceRequest;

class ProductPriceController
{
    public function index($productId)
    {
        return ProductUdm::where('producto_id', $productId)->get();
    }

    public function store(StoreProductPriceRequest $request, $productId)
    {
        $price = ProductUdm::create([
            'producto_id' => $productId,
            'unidad_medida_id' => $request->unidad_medida_id,
            'precio_compra' => $request->precio_compra,
            'precio_venta' => $request->precio_venta,
        ]);

        return response()->json($price, 201);
    }

}
