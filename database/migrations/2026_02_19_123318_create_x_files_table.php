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
        Schema::connection('simaster')->create('x_files', function (Blueprint $table) {
            $table->integer('xid', true);
            $table->string('xmarking', 200)->unique('xmarking');
            $table->text('xtabel')->nullable();
            $table->string('xjenis', 100)->nullable();
            $table->longText('xfile')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('x_files');
    }
};
