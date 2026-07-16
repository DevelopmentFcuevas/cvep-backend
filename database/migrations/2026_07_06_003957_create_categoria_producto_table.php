<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la tabla categoria_producto.
 * @author Francisco Cuevas
 * @since 2026-07-16
 * @description Tabla que almacena las categorías de productos.
 *  Las categorías de productos son agrupaciones de productos que comparten 
 * características similares. Por ejemplo: suministros, utiles, tintas, 
 * repuestos, accesorios, etc.
 * @version 1.0.0
 * @category Inventory
 * @package App\Modules\Inventory\Models
 */


return new class extends Migration
{
    /**
     * Run the migrations.
     * Nota: En Laravel, lo más conveniente es usar id para la clave primaria (PK) por 
     * convención de Eloquent (el ORM de Laravel), ya que asume id como PK por defecto;
     */
    public function up(): void
    {
        Schema::create('inventory.categoria_producto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('estado')->nullable()->default('ACTIVO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Se elimina la tabla categoria_producto.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory.categoria_producto');
    }
};
