<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Inventory\Controllers\ProductController;
use App\Modules\Inventory\Controllers\ProductPriceController;
use App\Modules\Inventory\Controllers\InventoryMovementController;


/*
 * Endpoints disponibles del API para productos.
 * Método   Endpoint            Descripción
 * GET      /api/products       Listar todos los productos.
 * POST     /api/products       Crear un producto.
 * GET      /api/products/{id}  Ver un producto.
 * PUT      /api/products/{id}  Actualizar un producto.
 * DELETE   /api/products/{id}  Eliminar un producto.
 *  
*/
// Route::apiResource('products', ProductController::class);
Route::prefix('products')->group(function () {
    /*
     * Esto le indica a Laravel: "Cuando llegue una petición GET aquí, busca la 
     * clase ProductController y ejecuta el método index".
     * */
    Route::get('/', [ProductController::class, 'index']);
    
    /*
     * Esto le indica a Laravel: "Cuando llegue una petición POST aquí, busca la 
     * clase ProductController y ejecuta el método store".
     * */
    Route::post('/', [ProductController::class, 'store']);

    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});


/**
 * Rutas de precios de productos....
 * Endpoints disponibles del API para Precios por Unidad.
 * Método   URL                                                     Acción
 * POST     /api/products/{productId}/prices                        Crear precio
 * GET      /api/products/{productId}/prices                        Listar precios
 * PUT      /api/products/{productId}/prices/{unidadMedidaId}       Actualizar precio
 * DELETE   /api/products/{productId}/prices/{unidadMedidaId}       Eliminar precio
 * 
 * Precios por Unidad de Medida pertenece a Producto.
 */
Route::prefix('products/{productId}')->group(function () {
    Route::get('prices', [ProductPriceController::class, 'index']);
    Route::post('prices', [ProductPriceController::class, 'store']);
    Route::put('prices/{unidadMedidaId}', [ProductPriceController::class, 'update']);
    Route::delete('prices/{unidadMedidaId}', [ProductPriceController::class, 'destroy']);
});
//Route::prefix('product-prices/{productId}')->group(function () {
//    Route::get('/', [ProductPriceController::class, 'index']);
//    Route::post('/', [ProductPriceController::class, 'store']);
//});



/**
 * Endpoints disponibles del API para Movimientos de Inventario.
 * Método   URL                                                     Acción
 * POST     /api/inventory/{productId}/movements                    Crear movimiento
 * 
 */
Route::prefix('inventory/{productId}')->group(function () {
    Route::post('movements', [InventoryMovementController::class, 'store']);
});


