<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_rm')->unique();
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('tanggal_lahir');
            $table->string('alamat');
            $table->string('no_telp');
            $table->integer('penjamin')->unsigned();
            $table->string('kode_perusahaan');
            $table->auditable();
            $table->timestamps();
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
        Schema::dropIfExists('pasiens');
    }
}
