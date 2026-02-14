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
        Schema::create('inventory.unidad_medida', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 20);
            $table->timestamps();
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
