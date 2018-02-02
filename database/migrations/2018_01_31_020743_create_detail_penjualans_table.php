<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans');
            $table->integer('penjualan_id')->unsigned();
            $table->integer('produk')->unsigned();
            $table->integer('penjamin')->unsigned();
            $table->string('nama_produk');
            $table->integer('harga_jual')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('potongan')->nullable();
            $table->integer('total')->nullable();
            $table->auditable();
            $table->timestamps();
            $table->foreign('penjualan_id')->references('id')
                    ->on('penjualans')->onDelete('cascade');
            $table->foreign('produk')->references('id')
                    ->on('produks');
            $table->foreign('penjamin')->references('id')
                    ->on('penjamins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penjualans');
    }
}
