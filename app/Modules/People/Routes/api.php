<?php

use Illuminate\Support\Facades\Route;
use App\Modules\People\Controllers\PersonaController;
use App\Modules\People\Controllers\ClienteController;
use App\Modules\People\Controllers\ProveedorController;
use App\Modules\People\Controllers\TelefonoController;

//Route::prefix('people')->group(function () {
//    Route::apiResource('persona', PersonaController::class);
//});

Route::prefix('providers')->group(function () {

    Route::get('/', [ProveedorController::class, 'index']);
    Route::post('/', [ProveedorController::class, 'store']);
    Route::get('/{id}', [ProveedorController::class, 'show']);
    Route::put('/{id}', [ProveedorController::class, 'update']);
    Route::delete('/{id}', [ProveedorController::class, 'destroy']);

});
