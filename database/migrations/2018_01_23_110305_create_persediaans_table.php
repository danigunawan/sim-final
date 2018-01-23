<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersediaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persediaans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans');
            $table->integer('produk')->unsigned();
            $table->string('nama_produk');
            $table->integer('harga_pokok')->nullable();
            $table->integer('total_nilai')->nullable();
            $table->integer('masuk')->nullable();
            $table->integer('keluar')->nullable();
            $table->string('jenis_transaksi');
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
        Schema::dropIfExists('persediaans');
    }
}
