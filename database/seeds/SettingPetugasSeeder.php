<?php

use Illuminate\Database\Seeder;
use App\SettingPetugas;

class SettingPetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SettingPetugas::create(['dokter' => 4,'perawat' => 3, 'farmasi' => 5]);
    }
}
