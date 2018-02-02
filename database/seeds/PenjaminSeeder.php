<?php

use Illuminate\Database\Seeder;
use App\Penjamin;

class PenjaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Penjamin::create(['nama' => 'UMUM','alamat' => 'jakarta','no_telp' => '081222' ,'level_harga' => 1]);
        Penjamin::create(['nama' => 'BPJS','alamat' => 'jakarta','no_telp' => '081222' ,'level_harga' => 2]);
    }
}
