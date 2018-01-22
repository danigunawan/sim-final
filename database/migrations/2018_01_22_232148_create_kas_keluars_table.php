<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKasKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas_keluars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans')->unique();
            $table->integer('kas')->unsigned();
            $table->integer('kategori_transaksi')->unsigned();
            $table->string('nama_kas');
            $table->string('nama_kategori_transaksi');
            $table->decimal('jumlah',15,2);
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('kas_keluars');
    }
}
