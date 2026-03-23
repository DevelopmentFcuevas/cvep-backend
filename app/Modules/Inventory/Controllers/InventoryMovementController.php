<?php

namespace App\Modules\Inventory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Inventory\Models\Product;
use App\Modules\Inventory\Models\Inventory;
use App\Modules\Inventory\Models\InventoryMovement;
use App\Modules\Inventory\Requests\StoreInventoryMovementRequest;
use Illuminate\Support\Facades\DB;



class InventoryMovementController extends Controller
{
    public function index()
    {
        return InventoryMovement::all();
    }

    public function store(StoreInventoryMovementRequest $request, $productId)
    {
        //$movement = InventoryMovement::create($request->validated());
        //return response()->json($movement, 201);

        return DB::transaction(function () use ($request, $productId) {
            
            // ✔ Verificar que el producto exista
            $product = Product::findOrFail($productId);

            // ✔ Obtener o crear el inventario del producto
            $inventory = Inventory::firstOrCreate(
                ['producto_id' => $productId],
                ['existencia_actual' => 0]
            );

            //  Cantidad a mover
            $cantidad = $request->cantidad;

            // ✔ Actualizar el stock según el tipo de movimiento
            if ($request->tipo_movimiento === 'salida') {

                if ($inventory->existencia_actual < $cantidad) {
                    return response()->json([
                        'message' => 'Stock insuficiente.'
                    ], 409);
                }

                $inventory->existencia_actual -= $cantidad;

            } elseif ($request->tipo_movimiento === 'entrada') {

                $inventory->existencia_actual += $cantidad;

            } else { // ajuste
                $inventory->existencia_actual = $cantidad;
            }
            // ✔ Guardar el inventario actualizado
            $inventory->save();

            // ✔ Crear el registro del movimiento
            $movement = InventoryMovement::create([
                'producto_id' => $productId,
                'tipo_movimiento' => $request->tipo_movimiento,
                'cantidad' => $cantidad,
                'motivo' => $request->motivo
            ]);

            // ✔ Retornar el movimiento creado
            return response()->json($movement, 201);
        });

    }


}