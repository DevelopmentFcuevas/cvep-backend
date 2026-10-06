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
        Schema::create('public.colores', function (Blueprint $table) {
            $table->id(); // PK autoincremental
            $table->string('nombre', 255); // Nombre del color
            $table->string('codigo_color', 30)->nullable(); // Codigo del color
            $table->string('estado', 10)->nullable()->default('ACTIVO'); // Estado del color
            $table->timestamps(); // Registra la fecha de creación y actualización
            $table->softDeletes(); // Registra la fecha de eliminación
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public.colores');
    }
};
