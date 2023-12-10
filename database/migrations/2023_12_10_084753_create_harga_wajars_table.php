<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harga_wajars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang');
            $table->integer('harga');
            $table->string('no_laporan_penilaian');
            $table->date('tgl_laporan_penilaian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('harga_wajars');
    }
};
