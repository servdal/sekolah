<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('simaster')->table('matching_keys', function (Blueprint $table) {
            $table->foreign(['left_id'])->references(['id'])->on('matching_lefts')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['right_id'])->references(['id'])->on('matching_rights')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->table('matching_keys', function (Blueprint $table) {
            $table->dropForeign('matching_keys_left_id_foreign');
            $table->dropForeign('matching_keys_right_id_foreign');
        });
    }
};
