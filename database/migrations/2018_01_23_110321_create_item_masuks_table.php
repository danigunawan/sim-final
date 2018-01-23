<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_masuks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans')->unique();
            $table->integer('produk')->unsigned();
            $table->string('nama_produk');
            $table->integer('harga_pokok')->nullable();
            $table->integer('total_nilai')->nullable();
            $table->integer('jumlah');
            $table->auditable();
            $table->timestamps();
            $table->foreign('produk')->references('id')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_masuks');
    }
}
