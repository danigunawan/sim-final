<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbsPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbs_pembelians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans')->nullable();
            $table->integer('pembelian_id')->nullable();
            $table->integer('produk')->unsigned();
            $table->string('nama_produk');
            $table->integer('harga_beli')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('potongan')->nullable();
            $table->integer('total')->nullable();
            $table->auditable();
            $table->timestamps();
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
        Schema::dropIfExists('tbs_pembelians');
    }
}
