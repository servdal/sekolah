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
        Schema::connection('simaster')->create('db_rapotan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('noinduk', 11)->nullable();
            $table->string('nama', 200)->nullable();
            $table->string('nisn', 50)->nullable();
            $table->string('foto', 200)->nullable();
            $table->string('alamat', 200)->nullable();
            $table->string('kelas', 15)->nullable();
            $table->string('semester', 25)->nullable();
            $table->string('tapel', 25)->nullable();
            $table->string('fase', 15)->nullable();
            $table->integer('n01')->nullable();
            $table->integer('n02')->nullable();
            $table->integer('n03')->nullable();
            $table->integer('n04')->nullable();
            $table->integer('n05')->nullable();
            $table->integer('n06')->nullable();
            $table->integer('n07')->nullable();
            $table->integer('n08')->nullable();
            $table->integer('n09')->nullable();
            $table->integer('n10')->nullable();
            $table->integer('n11')->nullable();
            $table->integer('n12')->nullable();
            $table->integer('n13')->nullable();
            $table->integer('n14')->nullable();
            $table->integer('n15')->nullable();
            $table->integer('n16')->nullable();
            $table->integer('n17')->nullable();
            $table->integer('n18')->nullable();
            $table->integer('n19')->nullable();
            $table->integer('n20')->nullable();
            $table->integer('n21')->nullable();
            $table->integer('n22')->nullable();
            $table->integer('n23')->nullable();
            $table->integer('n24')->nullable();
            $table->integer('n25')->nullable();
            $table->integer('n26')->nullable();
            $table->integer('n27')->nullable();
            $table->integer('n28')->nullable();
            $table->integer('n29')->nullable();
            $table->integer('n30')->nullable();
            $table->string('h01', 100)->nullable();
            $table->string('h02', 100)->nullable();
            $table->string('h03', 100)->nullable();
            $table->string('h04', 100)->nullable();
            $table->string('h05', 100)->nullable();
            $table->string('h06', 100)->nullable();
            $table->string('h07', 100)->nullable();
            $table->string('h08', 100)->nullable();
            $table->string('h09', 100)->nullable();
            $table->string('h10', 100)->nullable();
            $table->string('h11', 100)->nullable();
            $table->string('h12', 100)->nullable();
            $table->string('h13', 100)->nullable();
            $table->string('h14', 100)->nullable();
            $table->string('h15', 100)->nullable();
            $table->string('h16', 100)->nullable();
            $table->string('h17', 100)->nullable();
            $table->string('h18', 100)->nullable();
            $table->string('h19', 100)->nullable();
            $table->string('h20', 100)->nullable();
            $table->string('h21', 100)->nullable();
            $table->string('h22', 100)->nullable();
            $table->string('h23', 100)->nullable();
            $table->string('h24', 100)->nullable();
            $table->string('h25', 100)->nullable();
            $table->string('h26', 100)->nullable();
            $table->string('h27', 100)->nullable();
            $table->string('h28', 100)->nullable();
            $table->string('h29', 100)->nullable();
            $table->string('h30', 100)->nullable();
            $table->text('k01')->nullable();
            $table->text('k02')->nullable();
            $table->text('k03')->nullable();
            $table->text('k04')->nullable();
            $table->text('k05')->nullable();
            $table->text('k06')->nullable();
            $table->text('k07')->nullable();
            $table->text('k08')->nullable();
            $table->text('k09')->nullable();
            $table->text('k10')->nullable();
            $table->text('k11')->nullable();
            $table->text('k12')->nullable();
            $table->text('k13')->nullable();
            $table->text('k14')->nullable();
            $table->text('k15')->nullable();
            $table->text('k16')->nullable();
            $table->text('k17')->nullable();
            $table->text('k18')->nullable();
            $table->text('k19')->nullable();
            $table->text('k20')->nullable();
            $table->text('k21')->nullable();
            $table->text('k22')->nullable();
            $table->text('k23')->nullable();
            $table->text('k24')->nullable();
            $table->text('k25')->nullable();
            $table->text('k26')->nullable();
            $table->text('k27')->nullable();
            $table->text('k28')->nullable();
            $table->text('k29')->nullable();
            $table->text('k30')->nullable();
            $table->string('ekstrakulikuler1', 100)->nullable();
            $table->string('nildeskripsieks1')->nullable();
            $table->string('ekstrakulikuler2', 100)->nullable();
            $table->string('nildeskripsieks2')->nullable();
            $table->string('ekstrakulikuler3', 100)->nullable();
            $table->string('nildeskripsieks3')->nullable();
            $table->string('ekstrakulikuler4', 100)->nullable();
            $table->string('nildeskripsieks4')->nullable();
            $table->string('ekstrakulikuler5', 100)->nullable();
            $table->string('nildeskripsieks5')->nullable();
            $table->text('saran')->nullable();
            $table->decimal('total', 11)->nullable();
            $table->integer('jumlahmatpel')->nullable();
            $table->decimal('ratarata', 11)->nullable();
            $table->integer('rangking')->nullable();
            $table->decimal('tbs1', 11)->nullable();
            $table->decimal('tbs2', 11)->nullable();
            $table->decimal('bbs1', 11)->nullable();
            $table->decimal('bbs2', 11)->nullable();
            $table->string('pendengaran', 50)->nullable();
            $table->string('penglihatan', 50)->nullable();
            $table->string('gigi', 50)->nullable();
            $table->string('kesehatanlain', 50)->nullable();
            $table->string('prestasi1')->nullable();
            $table->string('ketprestasi1', 50)->nullable();
            $table->string('prestasi2')->nullable();
            $table->string('ketprestasi2', 50)->nullable();
            $table->string('prestasi3')->nullable();
            $table->string('ketprestasi3', 50)->nullable();
            $table->string('prestasi4')->nullable();
            $table->string('ketprestasi4', 50)->nullable();
            $table->integer('sakit')->nullable();
            $table->integer('ijin')->nullable();
            $table->integer('alpha')->nullable();
            $table->string('tanggal', 100)->nullable();
            $table->string('namaguru')->nullable();
            $table->string('nipguru', 50)->nullable();
            $table->string('namakepalasekolah')->nullable();
            $table->string('nipkepalasekolah', 50)->nullable();
            $table->string('keputusan', 150)->nullable();
            $table->string('naik', 150)->nullable();
            $table->date('markirim');
            $table->date('markcetak');
            $table->string('marking', 150)->unique('marking');
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
        Schema::connection('simaster')->dropIfExists('db_rapotan');
    }
};
