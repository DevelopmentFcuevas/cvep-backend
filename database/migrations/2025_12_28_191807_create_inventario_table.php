<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Nota: En Laravel, la convención estándar y más recomendada es utilizar el formato 
     * nombre_tabla_id (nombre de la tabla en singular, seguido de un guion bajo y el sufijo id).
     */
    public function up(): void
    {
        Schema::create('inventory.inventario', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('id_producto')->primary()->references('id_producto')->on('producto');
            $table->foreignId('producto_id')->references('id')->on('inventory.producto');
            $table->decimal('existencia_actual', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory.inventario');
    }
};
