<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKasMutasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas_mutasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans')->unique();
            $table->integer('dari_kas')->unsigned();
            $table->integer('ke_kas')->unsigned();
            $table->string('nama_dari_kas');
            $table->string('nama_ke_kas');
            $table->decimal('jumlah',15,2);
            $table->string('keterangan')->nullable();
            $table->auditable();
            $table->timestamps();
            $table->foreign('dari_kas')->references('id')->on('kas');
            $table->foreign('ke_kas')->references('id')->on('kas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kas_mutasis');
    }
}
