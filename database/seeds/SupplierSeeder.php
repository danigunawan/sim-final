<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Supplier::create(['nama' => 'afif','alamat' => 'lampung','no_telp' => '0812222']);
        Supplier::create(['nama' => 'dalfi','alamat' => 'lampung','no_telp' => '0812222']);
    }
}
