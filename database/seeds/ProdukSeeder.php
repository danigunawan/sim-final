<?php

use Illuminate\Database\Seeder;
use App\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Produk::create(['kode' => '11' ,'nama' => 'obat manjur' ,'kategori_produk' => 1,
                        'harga_beli' => 1000,'harga_jual_1' => 12000,
                        'satuan' => 1,'tipe_produk' => 'jasa']);
        Produk::create(['kode' => '22' ,'nama' => 'obat paling manjur' ,'kategori_produk' => 1,
                        'harga_beli' => 1000,'harga_jual_1' => 12000,
                        'satuan' => 1,'tipe_produk' => 'barang']);
    }
}
