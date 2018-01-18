<?php

use Illuminate\Database\Seeder;
use App\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Poli::create(['nama' => 'rawat jalan']);
        Poli::create(['nama' => 'rawat inap']);
    }
}
