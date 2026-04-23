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
        Schema::connection('simaster')->create('mushaf_ujianlisan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('noinduk', 11)->nullable();
            $table->string('nama', 200)->nullable();
            $table->string('kelas', 15)->nullable();
            $table->string('semester', 25)->nullable();
            $table->string('tapel', 25)->nullable();
            $table->string('niy1', 25)->nullable();
            $table->string('nama1')->nullable();
            $table->string('niy2', 25)->nullable();
            $table->string('nama2')->nullable();
            $table->string('niy3', 25)->nullable();
            $table->string('nama3')->nullable();
            $table->string('niypengujiibadah1', 25)->nullable();
            $table->string('niypengujiibadah2', 25)->nullable();
            $table->string('niypengujiibadah3', 25)->nullable();
            $table->string('namapengujiibadah1')->nullable();
            $table->string('namapengujiibadah2')->nullable();
            $table->string('namapengujiibadah3')->nullable();
            $table->string('niypengujilugot1', 25)->nullable();
            $table->string('niypengujilugot2', 25)->nullable();
            $table->string('niypengujilugot3', 25)->nullable();
            $table->string('namapengujilugot1')->nullable();
            $table->string('namapengujilugot2')->nullable();
            $table->string('namapengujilugot3')->nullable();
            $table->decimal('pengguji1inggris1', 11)->nullable();
            $table->decimal('pengguji1inggris2', 11)->nullable();
            $table->decimal('pengguji1inggris3', 11)->nullable();
            $table->decimal('pengguji1inggris4', 11)->nullable();
            $table->decimal('pengguji1inggris5', 11)->nullable();
            $table->decimal('pengguji1inggris6', 11)->nullable();
            $table->decimal('pengguji1inggris7', 11)->nullable();
            $table->decimal('pengguji2inggris1', 11)->nullable();
            $table->decimal('pengguji2inggris2', 11)->nullable();
            $table->decimal('pengguji2inggris3', 11)->nullable();
            $table->decimal('pengguji2inggris4', 11)->nullable();
            $table->decimal('pengguji2inggris5', 11)->nullable();
            $table->decimal('pengguji2inggris6', 11)->nullable();
            $table->decimal('pengguji2inggris7', 11)->nullable();
            $table->decimal('pengguji3inggris1', 11)->nullable();
            $table->decimal('pengguji3inggris2', 11)->nullable();
            $table->decimal('pengguji3inggris3', 11)->nullable();
            $table->decimal('pengguji3inggris4', 11)->nullable();
            $table->decimal('pengguji3inggris5', 11)->nullable();
            $table->decimal('pengguji3inggris6', 11)->nullable();
            $table->decimal('pengguji3inggris7', 11)->nullable();
            $table->decimal('pengguji1ibadah1', 11)->nullable();
            $table->decimal('pengguji1ibadah2', 11)->nullable();
            $table->decimal('pengguji1ibadah3', 11)->nullable();
            $table->decimal('pengguji1ibadah4', 11)->nullable();
            $table->decimal('pengguji1ibadah5', 11)->nullable();
            $table->decimal('pengguji2ibadah1', 11)->nullable();
            $table->decimal('pengguji2ibadah2', 11)->nullable();
            $table->decimal('pengguji2ibadah3', 11)->nullable();
            $table->decimal('pengguji2ibadah4', 11)->nullable();
            $table->decimal('pengguji2ibadah5', 11)->nullable();
            $table->decimal('pengguji3ibadah1', 11)->nullable();
            $table->decimal('pengguji3ibadah2', 11)->nullable();
            $table->decimal('pengguji3ibadah3', 11)->nullable();
            $table->decimal('pengguji3ibadah4', 11)->nullable();
            $table->decimal('pengguji3ibadah5', 11)->nullable();
            $table->decimal('pengguji1lugot1', 11)->nullable();
            $table->decimal('pengguji1lugot2', 11)->nullable();
            $table->decimal('pengguji1lugot3', 11)->nullable();
            $table->decimal('pengguji1lugot4', 11)->nullable();
            $table->decimal('pengguji1lugot5', 11)->nullable();
            $table->decimal('pengguji1lugot6', 11)->nullable();
            $table->decimal('pengguji1lugot7', 11)->nullable();
            $table->decimal('pengguji1lugot8', 11)->nullable();
            $table->decimal('pengguji2lugot1', 11)->nullable();
            $table->decimal('pengguji2lugot2', 11)->nullable();
            $table->decimal('pengguji2lugot3', 11)->nullable();
            $table->decimal('pengguji2lugot4', 11)->nullable();
            $table->decimal('pengguji2lugot5', 11)->nullable();
            $table->decimal('pengguji2lugot6', 11)->nullable();
            $table->decimal('pengguji2lugot7', 11)->nullable();
            $table->decimal('pengguji2lugot8', 11)->nullable();
            $table->decimal('pengguji3lugot1', 11)->nullable();
            $table->decimal('pengguji3lugot2', 11)->nullable();
            $table->decimal('pengguji3lugot3', 11)->nullable();
            $table->decimal('pengguji3lugot4', 11)->nullable();
            $table->decimal('pengguji3lugot5', 11)->nullable();
            $table->decimal('pengguji3lugot6', 11)->nullable();
            $table->decimal('pengguji3lugot7', 11)->nullable();
            $table->decimal('pengguji3lugot8', 11)->nullable();
            $table->decimal('allinggris1', 11)->nullable();
            $table->decimal('allinggris2', 11)->nullable();
            $table->decimal('allinggris3', 11)->nullable();
            $table->decimal('allinggris4', 11)->nullable();
            $table->decimal('allinggris5', 11)->nullable();
            $table->decimal('allinggris6', 11)->nullable();
            $table->decimal('allinggris7', 11)->nullable();
            $table->decimal('allibadah1', 11)->nullable();
            $table->decimal('allibadah2', 11)->nullable();
            $table->decimal('allibadah3', 11)->nullable();
            $table->decimal('allibadah4', 11)->nullable();
            $table->decimal('allibadah5', 11)->nullable();
            $table->decimal('alllugot1', 11)->nullable();
            $table->decimal('alllugot2', 11)->nullable();
            $table->decimal('alllugot3', 11)->nullable();
            $table->decimal('alllugot4', 11)->nullable();
            $table->decimal('alllugot5', 11)->nullable();
            $table->decimal('alllugot6', 11)->nullable();
            $table->decimal('alllugot7', 11)->nullable();
            $table->decimal('alllugot8', 11)->nullable();
            $table->string('penandatangan')->nullable();
            $table->string('marking', 125)->nullable()->unique('marking');
            $table->integer('id_sekolah')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('simaster')->dropIfExists('mushaf_ujianlisan');
    }
};
