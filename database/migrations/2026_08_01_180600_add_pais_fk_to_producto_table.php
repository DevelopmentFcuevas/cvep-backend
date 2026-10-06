<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('inventory.producto', function (Blueprint $table) {
            $table->foreign('pais_id')->references('id')->on('public.paises');
        });
    }

    public function down(): void {
        Schema::table('inventory.producto', function (Blueprint $table) {
            $table->dropForeign(['pais_id']);
        });
    }
};
