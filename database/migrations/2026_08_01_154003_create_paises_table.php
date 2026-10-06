<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Nota: En Laravel, lo más conveniente es usar id para la clave primaria (PK) por 
     * convención de Eloquent (el ORM de Laravel), ya que asume id como PK por defecto;
     */
    public function up(): void
    {
        Schema::create('public.paises', function (Blueprint $table) {
            $table->id(); // Primary Key (PK) autoincremental
            $table->string('nombre', 100)->nullable(); // Nombre del país
			$table->string('nacionalidad', 100)->nullable(); // Nacionalidad
			$table->string('cod_iso_2', 2)->nullable(); // Código ISO 2
			$table->string('cod_iso_3', 3)->nullable(); // Código ISO 3
			$table->string('prefijo_telefonico', 10)->nullable(); // Prefijo telefónico
            $table->string('estado', 10)->nullable()->default('ACTIVO'); // Estado
            $table->timestamps(); // Registra la fecha de creación y actualización
            $table->softDeletes(); // Registra la fecha de eliminación
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public.paises');
    }
};
