<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRuanganTerpakaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruangan_terpakais', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ruangan')->unsigned();
            $table->string('no_reg');
            $table->integer('status_ruangan');
            $table->auditable();
            $table->timestamps();
            $table->foreign('ruangan')->references('id')->on('ruangans');
            $table->foreign('no_reg')->references('no_reg')->on('registrasi_pasiens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruangan_terpakais');
    }
}
