<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualanPiutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_piutangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans');
            $table->integer('penjamin')->unsigned();
            $table->integer('jumlah_piutang');
            $table->integer('akan_dibayar')->nullable();
            //table ini sebenernya gak ada gunanya , cuma sebagai tampungan
            $table->auditable();
            $table->timestamps();
            $table->foreign('no_trans')->references('no_trans')->on('penjualans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan_piutangs');
    }
}
