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
        Schema::create('inventory.producto_udm', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('id_producto')->references('id')->on('producto');
            //$table->foreignId('id_udm')->references('id')->on('unidad_medida');
            $table->foreignId('producto_id')->references('id')->on('inventory.producto');
            $table->foreignId('unidad_medida_id')->references('id')->on('inventory.unidad_medida');
            $table->decimal('precio_compra', 10, 2);
            $table->decimal('precio_venta', 10, 2);
            //$table->primary(['id_producto', 'id_udm']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory.producto_udm');
    }
};
