<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjaminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjamins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->unique();
            $table->string('alamat');
            $table->integer('no_telp');
            $table->integer('level_harga');
            $table->auditable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjamins');
    }
}
