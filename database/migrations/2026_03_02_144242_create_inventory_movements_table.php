<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory.inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')
                ->constrained('inventory.producto')
                ->cascadeOnDelete();
            $table->enum('tipo_movimiento', ['entrada', 'salida', 'ajuste']);
            $table->decimal('cantidad', 10, 2);
            $table->string('motivo', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
