<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la tabla telefono.
 * 
 */

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts.telefono', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('persona_id')
                ->constrained('contacts.persona')
                ->cascadeOnDelete();
            $table->string('numero');
            $table->enum('tipo', ['fijo', 'movil', 'whatsapp'])->default('fijo');
            $table->boolean('principal')->default(false);
            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts.telefono');
    }
};
