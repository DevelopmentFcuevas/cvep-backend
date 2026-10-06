<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la tabla unidad_medida.
 * 
 */

return new class extends Migration
{
    /**
     * Run the migrations.
     * Nota: En Laravel, lo más conveniente es usar id para la clave primaria (PK) por 
     * convención de Eloquent (el ORM de Laravel), ya que asume id como PK por defecto;
     */
    public function up(): void
    {
        // Eliminar tabla si ya existe, incluyendo FK dependientes
        DB::statement('DROP TABLE IF EXISTS inventory.unidad_medida CASCADE');
        Schema::create('inventory.unidad_medida', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental.
            $table->string('nombre', 255)->unique(); // Nombre de la unidad de medida.
            $table->text('descripcion')->nullable()->default(''); // Descripción de la unidad de medida.
            $table->string('sigla', 10)->unique()->nullable(); // Sigla de la unidad de medida.
            $table->integer('decimal')->nullable()->default(0); // Número de decimales permitidos.
            $table->string('estado')->nullable()->default('ACTIVO'); // Estado de la unidad de medida.
            $table->timestamps(); // Marca de tiempo de creación.
            $table->softDeletes(); // Marca de tiempo de eliminación suave.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory.unidad_medida');
    }
};
