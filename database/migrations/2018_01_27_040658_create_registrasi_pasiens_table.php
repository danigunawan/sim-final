<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrasiPasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi_pasiens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_reg')->unique();
            $table->string('pasien');
            $table->integer('penjamin')->unsigned();
            $table->integer('dokter')->unsigned();
            $table->integer('poli')->unsigned();
            $table->string('keadaan_umum')->nullable();
            $table->string('alergi_obat')->nullable();
            $table->string('status_registrasi');
            $table->string('jenis_registrasi');
            $table->auditable();
            $table->timestamps();
            $table->foreign('pasien')->references('no_rm')->on('pasiens');
            $table->foreign('penjamin')->references('id')->on('penjamins');
            $table->foreign('dokter')->references('id')->on('users');
            $table->foreign('poli')->references('id')->on('polis');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrasi_pasiens');
    }
}
