<?php

use Illuminate\Database\Seeder;
use App\Pasien;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $noRm = Pasien::noRm();
        Pasien::create(['no_rm'=> $noRm,'nama' => 'afif',
                        'alamat' => 'lampung','jenis_kelamin'=> 'laki-laki',
                        'no_telp' => '099','penjamin' => 1,
                        'kode_perusahaan' => 'K01','tanggal_lahir' => '08-09-1995']);
        $noRm = Pasien::noRm();
        Pasien::create(['no_rm'=> $noRm,'nama' => 'dalfi',
                        'alamat' => 'lampung','jenis_kelamin'=> 'laki-laki',
                        'no_telp' => '099','penjamin' => 2,
                        'kode_perusahaan' => 'K01','tanggal_lahir' => '08-09-1995']);
    }
}
