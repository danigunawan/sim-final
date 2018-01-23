<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_kas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans');
            $table->integer('kas')->unsigned();
            $table->string('nama_kas');
            $table->integer('kategori_transaksi')->unsigned();
            $table->string('nama_kategori_transaksi');
            $table->string('jenis_transaksi');
            $table->decimal('masuk',15,2)->nullable();
            $table->decimal('keluar',15,2)->nullable();
            $table->auditable();
            $table->timestamps();
            $table->foreign('kas')->references('id')->on('kas');
            $table->foreign('kategori_transaksi')->references('id')->on('kategori_transaksis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_kas');
    }
}
