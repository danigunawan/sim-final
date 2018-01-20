<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SatuanSeeder::class);
        $this->call(PoliSeeder::class);
        $this->call(KategoriProdukSeeder::class);
        $this->call(KategoriTransaksiSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(KasSeeder::class);
        $this->call(PenjaminSeeder::class);
        $this->call(PerusahaanSeeder::class);
        $this->call(PasienSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(KomisiProdukSeeder::class);

    }
}
