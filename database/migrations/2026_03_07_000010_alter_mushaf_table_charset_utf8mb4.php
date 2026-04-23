<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::connection('simaster')->hasTable('mushaf')) {
            return;
        }

        DB::connection('simaster')->statement('ALTER TABLE mushaf CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    }

    public function down(): void
    {
        // Intentionally left blank.
    }
};
