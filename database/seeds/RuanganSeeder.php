<?php

use Illuminate\Database\Seeder;
use App\Ruangan;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Ruangan::create(['kode' => '01' ,'nama' => 'mawar' , 'jumlah_kasur' =>10]);
        Ruangan::create(['kode' => '02' ,'nama' => 'rose' , 'jumlah_kasur' =>10]);
    }
}
