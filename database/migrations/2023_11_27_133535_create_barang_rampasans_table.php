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
        Schema::create('barang_rampasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id');
            $table->string('nama_terdakwa');
            $table->string('nama_barang');
            $table->text('deskripsi');
            $table->string('foto_thumbnail');
            $table->string('no_putusan');
            $table->string('tgl_putusan');
            $table->text('foto_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_rampasans');
    }
};
