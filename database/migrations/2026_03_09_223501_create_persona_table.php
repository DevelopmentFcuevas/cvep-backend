<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la tabla persona.
 * 
 */

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts.persona', function (Blueprint $table) {
            $table->id();
            
            $table->string('tipo_persona')->nullable(); // Opcional si usas especialización pura.
            $table->string('nombre_razon_social');
            $table->string('ruc')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->text('descripcion_ubicacion')->nullable();
            //$table->string('telefono')->nullable();
            //$table->string('email')->nullable();
            //$table->string('fax')->nullable();
            //$table->string('web')->nullable();
            //$table->string('logo')->nullable();
            $table->string('estado')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts.persona');
    }
};
