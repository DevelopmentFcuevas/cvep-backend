<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la tabla purchase.
 * 
 */

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases.purchase', function (Blueprint $table) {
            $table->id();

            $table->foreignId('proveedor_id')
                ->constrained('contacts.persona')
                ->cascadeOnDelete();
            $table->date('fecha')->useCurrent();
            $table->decimal('total', 10, 2)->default(0);
            $table->enum('estado', ['PENDIENTE', 'CONFIRMADO', 'BORRADOR', 'IMPACTO_INVENTARIO', 'CANCELADA'])->default('PENDIENTE');
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases.purchase');
    }
};
