<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('inventory.producto', function (Blueprint $table) {
            if (Schema::hasColumn('inventory.producto', 'color')) {
                $table->dropColumn('color');
            }
            if (!Schema::hasColumn('inventory.producto', 'color_id')) {
                $table->foreignId('color_id')->nullable()->after('volumen');
            }
            $table->foreign('color_id')->references('id')->on('public.colores');
        });
    }

    public function down(): void {
        Schema::table('inventory.producto', function (Blueprint $table) {
            $table->dropForeign(['color_id']);
            $table->dropColumn('color_id');
            if (!Schema::hasColumn('inventory.producto', 'color')) {
                $table->string('color', 30)->nullable()->after('volumen');
            }
        });
    }
};
