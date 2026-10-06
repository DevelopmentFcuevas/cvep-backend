<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Eliminar tabla si ya existe, incluyendo FK dependientes
        DB::statement('DROP TABLE IF EXISTS inventory.marcas CASCADE');
        Schema::create('inventory.marcas', function (Blueprint $table) {
            $table->id(); // PK autoincremental
            $table->string('nombre', 255)->unique(); // Nombre de la marca
            $table->text('descripcion')->nullable(); // Descripción de la marca
            $table->string('abreviatura', 20)->nullable(); // Abreviatura de la marca
            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO'); // Estado de la marca
            $table->timestamps(); // Registra la fecha de creación y actualización
            $table->softDeletes(); // Registra la fecha de eliminación
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory.marcas');
    }
};
