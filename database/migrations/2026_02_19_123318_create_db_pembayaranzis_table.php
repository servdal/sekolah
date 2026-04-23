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
        Schema::connection('simaster')->create('db_pembayaranzis', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('namawali', 150);
            $table->string('hape', 50)->nullable();
            $table->string('namasiswa', 150);
            $table->string('kelas', 5);
            $table->string('jeniszakat', 15);
            $table->integer('orang');
            $table->decimal('nominal', 11)->nullable();
            $table->integer('zakatmaal')->nullable();
            $table->integer('donasi')->nullable();
            $table->string('validator', 150)->nullable();
            $table->date('tglvalidasi')->nullable();
            $table->string('marking', 200)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->integer('id_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('db_pembayaranzis');
    }
};
