<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Public\Controllers\PaisController;
use App\Modules\Public\Controllers\ColorController;

/**
 * Endpoints disponibles del API para paises.
 * Método   URL                                 Acción
 * GET      /api/paises                         Listar paises
 * POST     /api/paises                         Crear pais
 * GET      /api/paises/{id}                    Obtener pais
 * PUT      /api/paises/{id}                    Actualizar pais
 * DELETE   /api/paises/{id}                    Eliminar pais
 * 
 * Paises pertenece a Public.
 */
Route::prefix('paises')->group(function () {
    Route::get('/', [PaisController::class, 'index']);
    Route::post('/', [PaisController::class, 'store']);
    Route::get('/{id}', [PaisController::class, 'show']);
    Route::put('/{id}', [PaisController::class, 'update']);
    Route::delete('/{id}', [PaisController::class, 'destroy']);
});



/**
 * Endpoints disponibles del API para colores.
 * Método   URL                                 Acción
 * GET      /api/colores                        Listar colores
 * POST     /api/colores                        Crear color
 * GET      /api/colores/{id}                    Obtener color
 * PUT      /api/colores/{id}                    Actualizar color
 * DELETE   /api/colores/{id}                    Eliminar color
 * 
 * Colores pertenece a Public.
 */
Route::prefix('colores')->group(function () {
    Route::get('/', [ColorController::class, 'index']);
    Route::post('/', [ColorController::class, 'store']);
    Route::get('/{id}', [ColorController::class, 'show']);
    Route::put('/{id}', [ColorController::class, 'update']);
    Route::delete('/{id}', [ColorController::class, 'destroy']);
});