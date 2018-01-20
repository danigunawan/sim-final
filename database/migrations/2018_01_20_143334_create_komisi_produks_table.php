<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKomisiProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komisi_produks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produk_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('nama_produk');
            $table->string('nama_user');
            $table->decimal('jumlah_prosentase',15,2)->nullable();
            $table->decimal('jumlah_uang',15,2)->nullable();
            $table->string('jabatan');
            $table->timestamps();
            $table->foreign('produk_id')->references('id')->on('produks');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komisi_produks');
    }
}
