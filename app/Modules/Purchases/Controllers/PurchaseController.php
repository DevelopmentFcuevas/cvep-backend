<?php

namespace App\Modules\Purchases\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Purchases\Models\Purchase;
use App\Modules\Purchases\Models\PurchaseDetail;
use App\Modules\Purchases\Services\PurchaseService;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    protected $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    //protected $purchaseService;

    //public function __construct(PurchaseService $purchaseService)
    //{
    //    $this->purchaseService = $purchaseService;
    //}

    //public function confirmPurchase($purchaseId)
    //{
    //    try {
    //        $purchase = $this->purchaseService->confirmPurchase($purchaseId);
    //        return response()->json([
    //            'message' => 'Compra confirmada exitosamente',
    //            'purchase' => $purchase
    //        ]);
    //    } catch (\Exception $e) {
    //        return response()->json([
    //            'message' => 'Error al confirmar la compra',
    //            'error' => $e->getMessage()
    //        ], 500);
    //    }
    //}


    public function index() {
        //$purchases = Purchase::all();
        //return response()->json($purchases);

        return Purchase::with('details')->get();
    }

    public function store(Request $request) {
        //$purchase = Purchase::create($request->all());
        //return response()->json($purchase);

        return Purchase::create([
            'proveedor_id' => $request->proveedor_id,
            //'fecha' => $request->fecha,
            //'total' => $request->total,
            //'estado' => $request->estado,
        ]);
    }

    public function addDetail(Request $request, $id) {
        return PurchaseDetail::create([
            'purchase_id' => $id,
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'precio_compra' => $request->precio_compra,
            //'precio_unitario' => $request->precio_unitario,
            //'subtotal' => $request->subtotal,
            'subtotal' => $request->cantidad * $request->precio_compra,
        ]);
    }

    public function confirm($id, PurchaseService $purchaseService) {
        //$purchase = Purchase::find($id);
        //$purchase->estado = 'CONFIRMADA';
        //$purchase->save();
        //return response()->json($purchase);

        return $purchaseService->confirmPurchase($id);
    }

    public function cancel($id /*, PurchaseService $purchaseService*/)
    {
        try {
            //$purchase = $purchaseService->cancelPurchase($id);
            $purchase = $this->purchaseService->cancelPurchase($id);

            return response()->json([
                'message' => 'Compra anulada exitosamente',
                'purchase' => $purchase
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al anular la compra',
                'error' => $e->getMessage()
            ], 500);
        }
    }




}