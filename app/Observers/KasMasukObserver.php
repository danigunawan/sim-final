<?php

namespace App\Observers;

use App\KasMasuk;
use App\TransaksiKas;

class KasMasukObserver
{
    /**
     * Listen to the KasMasuk created event.
     *
     * @param  \App\KasMasuk  $kasMasuk
     * @return void
     */
    public function created(KasMasuk $kasMasuk)
    {
        //
          $transaksiKas = TransaksiKas::create(['no_trans' => $kasMasuk->no_trans,
                                                'kas' => $kasMasuk->kas,
                                                'kategori_transaksi' => $kasMasuk->kategori_transaksi,
                                                'nama_kas' => $kasMasuk->nama_kas,
                                                'nama_kategori_transaksi' => $kasMasuk->nama_kategori_transaksi,
                                                'jenis_transaksi' => 'kas_masuk',
                                                'masuk' => $kasMasuk->jumlah
                                                ]);
          if($transaksiKas){
            return true;
          } else {
            return false;
          }
    }


    public function updated(KasMasuk $kasMasuk){
          TransaksiKas::where('no_trans',$kasMasuk->no_trans)->delete();
          $transaksiKas = TransaksiKas::create(['no_trans' => $kasMasuk->no_trans,
                                                'kas' => $kasMasuk->kas,
                                                'kategori_transaksi' => $kasMasuk->kategori_transaksi,
                                                'nama_kas' => $kasMasuk->nama_kas,
                                                'nama_kategori_transaksi' => $kasMasuk->nama_kategori_transaksi,
                                                'jenis_transaksi' => 'kas_masuk',
                                                'masuk' => $kasMasuk->jumlah
                                                ]);
          if($transaksiKas){
            return true;
          } else {
            return false;
          }
    }

    /**
     * Listen to the KasMasuk deleting event.
     *
     * @param  \App\KasMasuk  $kasMasuk
     * @return void
     */
    public function deleting(KasMasuk $kasMasuk)
    {
        //
        $transaksiKas = TransaksiKas::where('no_trans',$kasMasuk->no_trans)->delete();
          
        if($transaksiKas){
            return true;
        } else {
            return false;
        }

    }
}

