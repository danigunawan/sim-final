<?php

namespace App\Observers;

use App\KasKeluar;
use App\TransaksiKas;

class KasKeluarObserver
{
    /**
     * Listen to the KasKeluar created event.
     *
     * @param  \App\KasKeluar  $kasKeluar
     * @return void
     */
    public function created(KasKeluar $kasKeluar)
    {
        //
          $transaksiKas = TransaksiKas::create(['no_trans' => $kasKeluar->no_trans,
                                                'kas' => $kasKeluar->kas,
                                                'kategori_transaksi' => $kasKeluar->kategori_transaksi,
                                                'nama_kas' => $kasKeluar->nama_kas,
                                                'nama_kategori_transaksi' => $kasKeluar->nama_kategori_transaksi,
                                                'jenis_transaksi' => 'kas_keluar',
                                                'keluar' => $kasKeluar->jumlah
                                                ]);
          if($transaksiKas){
            return true;
          } else {
            return false;
          }
    }


    public function updated(KasKeluar $kasKeluar){
          TransaksiKas::where('no_trans',$kasKeluar->no_trans)->delete();
          $transaksiKas = TransaksiKas::create(['no_trans' => $kasKeluar->no_trans,
                                                'kas' => $kasKeluar->kas,
                                                'kategori_transaksi' => $kasKeluar->kategori_transaksi,
                                                'nama_kas' => $kasKeluar->nama_kas,
                                                'nama_kategori_transaksi' => $kasKeluar->nama_kategori_transaksi,
                                                'jenis_transaksi' => 'kas_keluar',
                                                'keluar' => $kasKeluar->jumlah
                                                ]);
          if($transaksiKas){
            return true;
          } else {
            return false;
          }
    }

    /**
     * Listen to the KasKeluar deleting event.
     *
     * @param  \App\KasKeluar  $kasKeluar
     * @return void
     */
    public function deleting(KasKeluar $kasKeluar)
    {
        //
        $transaksiKas = TransaksiKas::where('no_trans',$kasKeluar->no_trans)->delete();
          
        if($transaksiKas){
            return true;
        } else {
            return false;
        }

    }
}

