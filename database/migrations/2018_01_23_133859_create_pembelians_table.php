<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans')->unique();
            $table->string('no_faktur_supplier')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('tanggal_jt')->nullable();
            $table->integer('potongan')->nullable();
            $table->integer('supplier')->unsigned();
            $table->string('nama_supplier');
            $table->integer('kas')->unsigned()->nullable();
            $table->string('nama_kas')->nullable();
            $table->integer('jumlah_bayar')->nullable();
            $table->integer('hutang_awal')->nullable();
            $table->integer('jumlah_produk');
            $table->integer('total_nilai');
            $table->string('status_beli_awal');
            $table->auditable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelians');
    }
}
