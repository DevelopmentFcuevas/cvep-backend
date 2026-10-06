<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        // Eliminar la tabla si ya existe (incluyendo restricciones dependientes)
        DB::statement('DROP TABLE IF EXISTS inventory.categoria_producto CASCADE');
        Schema::create('inventory.categoria_producto', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental.
            $table->string('nombre', 255); // Nombre de la categoría de producto.
            $table->text('descripcion')->nullable()->default(''); // Descripción de la categoría de producto.
            $table->string('sigla', 10)->nullable()->default(''); // Sigla de la categoría de producto.
            $table->string('estado')->nullable()->default('ACTIVO'); // Estado de la categoría de producto.
            $table->timestamps(); // Marca de tiempo de creación.
            $table->softDeletes(); // Marca de tiempo de eliminación suave.
        });
    }

    /**
     * Reverse the migrations.
     * Se elimina la tabla categoria_producto.
     * @return void
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('inventory.producto', function (Blueprint $table) {
            $table->dropForeign(['categoria_producto_id']);
        });
        Schema::dropIfExists('inventory.categoria_producto');
        Schema::enableForeignKeyConstraints();
    }
};
