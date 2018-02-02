<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\KasMasuk;
use App\Observers\KasMasukObserver;
use App\KasKeluar;
use App\Observers\KasKeluarObserver;
use App\KasMutasi;
use App\observers\KasMutasiObserver;
use App\ItemMasuk;
use App\observers\ItemMasukObserver;
use App\ItemKeluar;
use App\observers\ItemKeluarObserver;
use App\Pembelian;
use App\observers\PembelianObserver;
use App\DetailPembelian;
use App\observers\DetailPembelianObserver;
use App\Penjualan;
use App\observers\PenjualanObserver;
use App\DetailPenjualan;
use App\observers\DetailPenjualanObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
          Schema::defaultStringLength(191);
          Pembelian::observe(PembelianObserver::class);
          DetailPembelian::observe(DetailPembelianObserver::class);
          Penjualan::observe(PenjualanObserver::class);
          DetailPenjualan::observe(DetailPenjualanObserver::class);
          ItemMasuk::observe(ItemMasukObserver::class);
          ItemKeluar::observe(ItemKeluarObserver::class);
          KasMasuk::observe(KasMasukObserver::class);
          KasKeluar::observe(KasKeluarObserver::class);
          KasMutasi::observe(KasMutasiObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
