<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la tabla producto.
 * 
 */

return new class extends Migration
{
    /**
     * Run the migrations.
     * Nota: En Laravel, lo más conveniente es usar id para la clave primaria (PK) por 
     * convención de Eloquent (el ORM de Laravel), ya que asume id como PK por defecto;
     * Nota: En Laravel, la convención estándar y más recomendada es utilizar el formato 
     * nombre_tabla_id (nombre de la tabla en singular, seguido de un guion bajo y 
     * el sufijo id) para la clave foranea (FK).
     */
    public function up(): void
    {
        Schema::create('inventory.producto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('marca', 50)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('color', 30)->nullable();
            $table->string('pais_origen', 50)->nullable();
            $table->integer('porcentaje_iva');
            $table->foreignId('familia_producto_id')->references('id')->on('inventory.familia_producto');
            $table->foreignId('unidad_medida_id')->references('id')->on('inventory.unidad_medida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory.producto');
    }
};
