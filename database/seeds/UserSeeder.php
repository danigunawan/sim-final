<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['email' => 'admin@gmail.com',
                      'name' => 'admin',
                     'jabatan' => 'admin',
                     'password' => bcrypt('rahasia'),
                      'konfirmasi_admin' => 1]);
        User::create(['email' => 'member@gmail.com',
                      'name' => 'member', 
                     'jabatan' => 'keuangan',
                     'password' => bcrypt('rahasia'),
                      'konfirmasi_admin' => 1]);
        User::create(['email' => 'perawat@gmail.com',
                      'name' => 'perawat', 
                     'jabatan' => 'perawat',
                     'password' => bcrypt('rahasia'),
                      'konfirmasi_admin' => 0]);
        User::create(['email' => 'dokter@gmail.com',
                      'name' => 'dokter', 
                     'jabatan' => 'dokter',
                     'password' => bcrypt('rahasia'),
                      'konfirmasi_admin' => 0]);
        User::create(['email' => 'farmasi@gmail.com',
                      'name' => 'farmasi', 
                     'jabatan' => 'farmasi',
                     'password' => bcrypt('rahasia'),
                      'konfirmasi_admin' => 0]);
        //
    }
}

