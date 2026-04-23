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
        Schema::connection('simaster')->create('umum_qrcode', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('inputor');
            $table->string('jenis', 100)->nullable();
            $table->mediumText('val01')->nullable();
            $table->mediumText('val02')->nullable();
            $table->mediumText('val03')->nullable();
            $table->mediumText('val04')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('umum_qrcode');
    }
};
