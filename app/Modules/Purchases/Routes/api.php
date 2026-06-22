<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Purchases\Controllers\PurchaseController;

Route::prefix('purchases')->group(function () {
    Route::get('/', [PurchaseController::class, 'index']);
    Route::post('/', [PurchaseController::class, 'store']);

    //Route::post('/{id}/add-detail', [PurchaseController::class, 'addDetail']);
    Route::post('/{id}/detail', [PurchaseController::class, 'addDetail']);
    
    Route::post('/{id}/confirm', [PurchaseController::class, 'confirm']);

    Route::post('/{id}/cancel', [PurchaseController::class, 'cancel']);
});
