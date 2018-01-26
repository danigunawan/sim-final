<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans');
            $table->integer('pembelian_id')->unsigned();
            $table->integer('produk')->unsigned();
            $table->string('nama_produk');
            $table->integer('harga_beli')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('potongan')->nullable();
            $table->integer('total')->nullable();
            $table->auditable();
            $table->timestamps();
            $table->foreign('pembelian_id')->references('id')
                    ->on('pembelians')->onDelete('cascade');
            $table->foreign('produk')->references('id')
                    ->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pembelians');
    }
}
