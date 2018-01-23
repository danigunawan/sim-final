<?php

use Illuminate\Database\Seeder;
use App\KategoriTransaksi;

class KategoriTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        KategoriTransaksi::create(['nama' => 'jajan']);
        KategoriTransaksi::create(['nama' => 'beli gecko']);
        KategoriTransaksi::create(['nama' => 'Mutasi']);
        KategoriTransaksi::create(['nama' => 'Biaya']);
        KategoriTransaksi::create(['nama' => 'Modal']);
        KategoriTransaksi::create(['nama' => 'Penjualan']);
        KategoriTransaksi::create(['nama' => 'Pembelian']);

    }
}
