<?php

use Illuminate\Database\Seeder;
use App\Perusahaan;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Perusahaan::create(['kode' => 'K01','nama' =>'KLINIK KOSASIH','alamat' => 'lampung','no_telp' => '081222']);
    }
}
