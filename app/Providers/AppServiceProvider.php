<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\KasMasuk;
use App\Observers\KasMasukObserver;
use App\KasKeluar;
use App\Observers\KasKeluarObserver;

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
          KasMasuk::observe(KasMasukObserver::class);
          KasKeluar::observe(KasKeluarObserver::class);
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
