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
        for ($i=1 ; $i < 6 ; $i++) {
          KomisiProduk::create([
                      'produk_id'=> 1,'user_id' => $i,
                      'nama_produk' => 'obat manjur','nama_user' => 'admin',
                      'jumlah_prosentase' => 10,
                      'jumlah_uang' => 200,
                      'jabatan' => 'admin'
                      ]);
          KomisiProduk::create([
                      'produk_id'=> 2,'user_id' => $i,
                      'nama_produk' => 'obat manjur','nama_user' => 'admin',
                      'jumlah_prosentase' => 10,
                      'jumlah_uang' => 200,
                      'jabatan' => 'admin'
                      ]);
        }
    }
}
