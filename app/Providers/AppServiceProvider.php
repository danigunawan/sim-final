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
