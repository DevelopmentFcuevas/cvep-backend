<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Eliminar el esquema contacts (incluye todas sus tablas) y volver a crear.
        DB::statement('DROP SCHEMA IF EXISTS contacts CASCADE');
        DB::statement('CREATE SCHEMA contacts');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP SCHEMA IF EXISTS contacts CASCADE');
    }
};
