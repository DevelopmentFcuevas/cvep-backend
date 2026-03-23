<?php
namespace App\Modules\Inventory\Controllers;

use App\Modules\Inventory\Models\ProductUdM;
use App\Modules\Inventory\Requests\StoreProductPriceRequest;
use App\Modules\Inventory\Requests\UpdateProductPriceRequest;
use App\Http\Controllers\Controller;
use App\Modules\Inventory\Models\Product;

class ProductPriceController extends Controller
{
    public function index($productId)
    {
        return ProductUdm::where('producto_id', $productId)->get();
    }

    public function store(StoreProductPriceRequest $request, $productId)
    {
        // ✔ Validar que el producto exista
        Product::findOrFail($productId);

        $price = ProductUdm::create([
            'producto_id' => $productId,
            'unidad_medida_id' => $request->unidad_medida_id,
            'precio_compra' => $request->precio_compra,
            'precio_venta' => $request->precio_venta,
        ]);

        return response()->json($price, 201);
    }

    public function update(UpdateProductPriceRequest $request, $productId, $unidadMedidaId)
    {
        // ✔ Verificar que el producto exista
        Product::findOrFail($productId);

        // Buscar el precio que pertenezca a ese producto
        $price = ProductUdm::where('producto_id', $productId)
            ->where('unidad_medida_id', $unidadMedidaId)
            ->firstOrFail();

        $price->update($request->validated());

        return response()->json($price);
    }

    public function destroy($productId, $unidadMedidaId)
    {
        // ✔ Verificar que el producto exista
        Product::findOrFail($productId);

        // Buscar el precio que pertenezca a ese producto
        $price = ProductUdm::where('producto_id', $productId)
            ->where('unidad_medida_id', $unidadMedidaId)
            ->firstOrFail();

        $price->delete();

        //return response()->json(null, 204);
        return response()->json([
            'message' => 'Precio eliminado correctamente',
        ]);
    }

}
