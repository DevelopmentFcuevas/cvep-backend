<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la tabla proveedor.
 * 
 * 🔹 Tabla proveedor (especialización 1–1)
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts.proveedor', function (Blueprint $table) {
            $table->id();

            $table->foreignId('persona_id')
                ->constrained('contacts.persona')
                ->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts.proveedor');
    }
};
