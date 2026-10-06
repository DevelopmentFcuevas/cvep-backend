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
            $table->id(); // PK autoincremental
            $table->string('nombre', 100); // Nombre del producto
            $table->foreignId('marca_id')->references('id')->on('inventory.marcas'); // FK a la tabla marca
            $table->string('codigo_barras', 20)->nullable(); // Codigo de barras del producto
            $table->text('descripcion')->nullable(); // Descripción del producto
            $table->string('modelo', 100)->nullable(); // Modelo del producto
            $table->string('serie', 100)->nullable(); // Serie del producto
            $table->text('notas')->nullable(); // Notas del producto
            $table->decimal('peso', 10, 2)->nullable(); // Peso del producto
            $table->decimal('volumen', 10, 2)->nullable(); // Volumen del producto
            $table->foreignId('color_id')->nullable(); // FK a la tabla color
            $table->foreignId('pais_id')->nullable(); // FK a la tabla pais
            $table->foreignId('categoria_producto_id')->references('id')->on('inventory.categoria_producto');
            $table->foreignId('unidad_medida_id')->references('id')->on('inventory.unidad_medida');
            $table->string('estado')->nullable()->default('ACTIVO'); // Estado del producto.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('inventory.producto');
        Schema::enableForeignKeyConstraints();
    }
};
