<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('nama')->unique();
            $table->string('tipe_produk');
            $table->integer('kategori_produk')->unsigned();
            $table->integer('satuan')->unsigned();
            $table->float('harga_beli')->default(0.00);
            $table->float('harga_jual_1')->default(0.00);
            $table->float('harga_jual_2')->nullable();
            $table->float('harga_jual_3')->nullable();
            $table->timestamps();
            $table->foreign('kategori_produk')->references('id')->on('kategori_produks');
            $table->foreign('satuan')->references('id')->on('satuans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
