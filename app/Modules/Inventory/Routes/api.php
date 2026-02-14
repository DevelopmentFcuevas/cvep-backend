<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Inventory\Controllers\ProductController;
use App\Modules\Inventory\Controllers\ProductPriceController;

//Route::apiResource('products', ProductController::class);

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
    //Route::get('/{id}', [ProductController::class, 'show']);
    //Route::put('/{id}', [ProductController::class, 'update']);
    //Route::delete('/{id}', [ProductController::class, 'destroy']);
});

/**
 * Rutas de precios de productos.
 */
/*Route::prefix('products/{productId}')->group(function () {
    Route::get('prices', [ProductPriceController::class, 'index']);
    Route::post('prices', [ProductPriceController::class, 'store']);
});*/
Route::prefix('product-prices/{productId}')->group(function () {
    Route::get('/', [ProductPriceController::class, 'index']);
    Route::post('/', [ProductPriceController::class, 'store']);
});



