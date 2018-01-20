<?php

use Illuminate\Database\Seeder;
use App\KomisiProduk;

class KomisiProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        KomisiProduk::create([
                    'produk_id'=> 1,'user_id' => 1,
                    'nama_produk' => 'obat manjur','nama_user' => 'admin',
                    'jumlah_prosentase' => 10,
                    'jumlah_uang' => 2,
                    'jabatan' => 'admin'
                    ]);
        KomisiProduk::create([
                    'produk_id'=> 2,'user_id' => 1,
                    'nama_produk' => 'obat manjur','nama_user' => 'admin',
                    'jumlah_prosentase' => 10,
                    'jumlah_uang' => 2,
                    'jabatan' => 'admin'
                    ]);
    }
}
