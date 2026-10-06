<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Eliminar el esquema completo para asegurarnos de que no queden tablas residuales.
        DB::statement('DROP SCHEMA IF EXISTS inventory CASCADE');
        DB::statement('CREATE SCHEMA inventory');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP SCHEMA IF EXISTS inventory CASCADE');
    }
};
