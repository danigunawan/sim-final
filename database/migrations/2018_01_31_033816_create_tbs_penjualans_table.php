<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbsPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbs_penjualans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_trans')->nullable();
            $table->string('no_reg')->nullable();
            $table->integer('penjualan_id')->nullable();
            $table->integer('produk')->unsigned();
            $table->integer('penjamin')->unsigned();
            $table->string('nama_produk');
            $table->integer('harga_jual')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('potongan')->nullable();
            $table->integer('total')->nullable();
            $table->auditable();
            $table->timestamps();
            $table->foreign('produk')->references('id')
                    ->on('produks');
            $table->foreign('penjamin')->references('id')
                    ->on('penjamins');
            $table->foreign('no_reg')->references('no_reg') ->on('registrasi_pasiens');
        
        }); 
    }
        /** * Reverse the migrations.  * * @return void */ 
    public function down() { 
      Schema::dropIfExists('tbs_detail_penjualans'); 
    } 
}
