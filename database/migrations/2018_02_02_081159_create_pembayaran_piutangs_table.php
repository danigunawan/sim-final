<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranPiutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_piutangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans_pembayaran')->unique();
            $table->integer('penjamin')->unsigned();
            $table->integer('jumlah_penjualan_dibayar');
            $table->date('dari_tanggal');
            $table->date('sampai_tanggal');
            $table->integer('total_pembayaran');
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
        Schema::dropIfExists('pembayaran_piutangs');
    }
}
