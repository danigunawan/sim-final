<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans')->unique();
            $table->string('no_reg')->nullable();
            $table->string('jenis_penjualan');
            $table->string('tanggal_jt')->nullable();
            $table->integer('potongan')->nullable();
            $table->integer('kas')->unsigned()->nullable();
            $table->string('nama_kas')->nullable();
            $table->integer('penjamin')->unsigned()->nullable();
            $table->string('nama_penjamin')->nullable();
            $table->integer('jumlah_bayar')->nullable();
            $table->integer('piutang_awal')->nullable();
            $table->integer('jumlah_produk');
            $table->integer('total_nilai');
            $table->string('status_jual_awal');
            $table->auditable();
            $table->timestamps();
            $table->foreign('no_reg')->references('no_reg')->on('registrasi_pasiens');
            $table->foreign('kas')->references('id')->on('kas');
            $table->foreign('penjamin')->references('id')->on('penjamins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
}
