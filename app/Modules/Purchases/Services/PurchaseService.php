<?php
namespace App\Modules\Purchases\Services;

use Illuminate\Support\Facades\DB;

use App\Modules\Purchases\Models\Purchase;
use App\Modules\Inventory\Models\Inventory;
use App\Modules\Inventory\Models\InventoryMovement;
use App\Modules\Purchases\Models\PurchaseDetail;

class PurchaseService
{
    //public function createPurchase(array $data)
    //{
    //    $purchase = Purchase::create($data);
    //    return $purchase;
    //}

    //public function createPurchaseDetail(array $data)
    //{
    //    $purchaseDetail = PurchaseDetail::create($data);
    //    return $purchaseDetail;
    //}


    public function confirmPurchase($purchaseId)
    {
        //DB::beginTransaction();

        //try {
        //    $purchase = Purchase::with('details')->findOrFail($purchaseId);

        //    if ($purchase->estado === 'CONFIRMADO') {
        //        throw new \Exception('La compra ya está confirmada');
        //    }

        //    $total = 0;
        //    foreach ($purchase->details as $detail) {

        //        // 1. Movimiento inventario
        //        InventoryMovement::create([
        //            'producto_id' => $detail->producto_id,
        //            'tipo_movimiento' => 'ENTRADA',
        //            'cantidad' => $detail->cantidad,
        //            'referencia' => 'COMPRA #' . $purchase->id
        //        ]);

        //        // 2. Actualizar stock
        //        $inventory = Inventory::firstOrCreate(
        //            ['producto_id' => $detail->producto_id],
        //            ['existencia_actual' => 0]
        //        );

        //        $inventory->increment('existencia_actual', $detail->cantidad);

        //        // 3. Total
        //        $total += $detail->subtotal;
        //    }

        //    $purchase->update([
        //        'estado' => 'CONFIRMADO',
        //        'total' => $total
        //    ]);

        //    DB::commit();

        //    return $purchase;

        //} catch (\Exception $e) {
        //    DB::rollBack();
        //    throw $e;
        //}

        

        DB::beginTransaction();

        try {
            $purchase = Purchase::with('details')->findOrFail($purchaseId);

            // ✅ VALIDACIONES FUERTES
            if ($purchase->estado !== Purchase::BORRADOR) {
                throw new \Exception('Solo compras en borrador pueden confirmarse');
            }

            if ($purchase->details->isEmpty()) {
                throw new \Exception('La compra no tiene productos');
            }

            $total = 0;

            foreach ($purchase->details as $detail) {
                if ($detail->cantidad <= 0) {
                    throw new \Exception('Cantidad inválida en detalle');
                }

                if ($detail->precio_unitario < 0) {
                    throw new \Exception('Precio inválido');
                }

                // Movimiento
                InventoryMovement::create([
                    'producto_id' => $detail->producto_id,
                    'tipo_movimiento' => 'ENTRADA',
                    'cantidad' => $detail->cantidad,
                    'referencia' => 'COMPRA #' . $purchase->id
                ]);

                // Stock
                $inventory = Inventory::firstOrCreate(
                    ['producto_id' => $detail->producto_id],
                    ['existencia_actual' => 0]
                );

                $inventory->increment('existencia_actual', $detail->cantidad);

                $total += $detail->subtotal;
            }

            if ($total <= 0) {
                throw new \Exception('Total inválido');
            }

            $purchase->update([
                'estado' => Purchase::CONFIRMADO,
                'total' => $total
            ]);

            DB::commit();

            return $purchase;

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

    }


    public function cancelPurchase($purchaseId)
    {
        DB::beginTransaction();

        try {

            $purchase = Purchase::with('details')->findOrFail($purchaseId);

            if ($purchase->estado !== Purchase::CONFIRMADO) {
                throw new \Exception('Solo compras confirmadas pueden anularse');
            }

            foreach ($purchase->details as $detail) {

                // Movimiento inverso
                InventoryMovement::create([
                    'producto_id' => $detail->producto_id,
                    'tipo_movimiento' => 'SALIDA',
                    'cantidad' => $detail->cantidad,
                    'referencia' => 'ANULACION COMPRA #' . $purchase->id
                ]);

                $inventory = Inventory::where('producto_id', $detail->producto_id)->first();

                if (!$inventory || $inventory->existencia_actual < $detail->cantidad) {
                    throw new \Exception('Stock insuficiente para anular');
                }

                $inventory->decrement('existencia_actual', $detail->cantidad);
            }

            $purchase->update([
                'estado' => Purchase::ANULADO
            ]);

            DB::commit();

            return $purchase;

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }



}
