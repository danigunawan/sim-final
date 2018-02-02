<?php

use Illuminate\Database\Seeder;
use App\SettingDefault;

class SettingDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SettingDefault::create(['text' => 'penjamin' ,'value' => '1']);
        SettingDefault::create(['text' => 'kas' ,'value' => '1']);
        SettingDefault::create(['text' => 'dokter' ,'value' => '1']);
    }
}
