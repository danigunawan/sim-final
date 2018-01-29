<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekamMediksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam_mediks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('registrasi')->unsigned();
            $table->string('sistole_diastole')->nullable();
            $table->string('frekuensi_pernapasan')->nullable();
            $table->string('suhu')->nullable();
            $table->string('nadi')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('anamnesa')->nullable();
            $table->string('pemeriksaan_fisik')->nullable();
            $table->string('keadaan_umum')->nullable();
            $table->string('kesadaran')->nullable();
            $table->string('diagnosis_utama')->nullable();
            $table->string('diagnosis_penyerta')->nullable();
            $table->string('diagnosis_penyerta_tambahan')->nullable();
            $table->string('komplikasi')->nullable();
            $table->string('keadaan_pulang')->nullable();
            $table->auditable();
            $table->timestamps();
            $table->foreign('registrasi')->references('id')->on('registrasi_pasiens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekam_mediks');
    }
}
