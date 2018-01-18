<?php

use Illuminate\Database\Seeder;
use App\Kas;

class KasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Kas::create(['kode' => '1' ,'nama' => 'bri']);
        Kas::create(['kode' => '2' ,'nama' => 'bni']);
    }
}
