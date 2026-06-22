<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la tabla familia_producto.
 * @author Francisco Cuevas
 * @since 2025-12-27
 * @description Tabla que almacena las familias de productos.
 *  Las familias de productos son agrupaciones de productos que comparten 
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
        Schema::create('inventory.familia_producto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('estado')->nullable()->default('ACTIVO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory.familia_producto');
    }
};
