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
        Schema::connection('simaster')->create('matching_keys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('left_id')->index('matching_keys_left_id_foreign');
            $table->unsignedBigInteger('right_id')->index('matching_keys_right_id_foreign');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('matching_keys');
    }
};
