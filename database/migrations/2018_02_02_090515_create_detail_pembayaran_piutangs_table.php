<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPembayaranPiutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembayaran_piutangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans_pembayaran');
            $table->string('no_trans_penjualan');
            $table->integer('jumlah_bayar');
            $table->auditable();
            $table->timestamps();
            $table->foreign('no_trans_pembayaran')->references('no_trans_pembayaran')
                    ->on('pembayaran_piutangs');
            $table->foreign('no_trans_penjualan')->references('no_trans')
                    ->on('penjualans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pembayaran_piutangs');
    }
}
