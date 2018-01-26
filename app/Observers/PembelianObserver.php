<?php

namespace App\Observers;

use App\Pembelian;
use App\TransaksiKas;
use App\KategoriTransaksi;

class PembelianObserver
{
    /**
     * Listen to the Pembelian created event.
     *
     * @param  \App\Pembelian  $pembelian
     * @return void
     */
    public function created(Pembelian $pembelian)
    {
        //
          if($pembelian->jumlah_bayar > 0){
              
          $kategoriTransaksi = KategoriTransaksi::where('nama','Pembelian')->first();
          $transaksiKas = TransaksiKas::create(['no_trans' => $pembelian->no_trans,
                                                'kas' => $pembelian->kas,
                                                'kategori_transaksi' => $kategoriTransaksi->id,
                                                'nama_kas' => $pembelian->nama_kas,
                                                'nama_kategori_transaksi' => $kategoriTransaksi->nama,
                                                'jenis_transaksi' => 'pembelian',
                                                'keluar' => $pembelian->jumlah_bayar
                                                ]);
          } else {
           $transaksiKas = true;
          }

          if($transaksiKas){
            return true;
          } else {
            return false;
          }
    }


    public function updated(Pembelian $pembelian){
          TransaksiKas::where('no_trans',$pembelian->no_trans)->delete();
          if($pembelian->jumlah_bayar > 0){
              
          $kategoriTransaksi = KategoriTransaksi::where('nama','Pembelian')->first();
          $transaksiKas = TransaksiKas::create(['no_trans' => $pembelian->no_trans,
                                                'kas' => $pembelian->kas,
                                                'kategori_transaksi' => $kategoriTransaksi->id,
                                                'nama_kas' => $pembelian->nama_kas,
                                                'nama_kategori_transaksi' => $kategoriTransaksi->nama,
                                                'jenis_transaksi' => 'pembelian',
                                                'keluar' => $pembelian->jumlah_bayar
                                                ]);
          } else {
           $transaksiKas = true;
          }

          if($transaksiKas){
            return true;
          } else {
            return false;
          }
    }

    /**
     * Listen to the Pembelian deleting event.
     *
     * @param  \App\Pembelian  $pembelian
     * @return void
     */
    public function deleting(Pembelian $pembelian)
    {
        //
        $transaksiKas = TransaksiKas::where('no_trans',$pembelian->no_trans);
        if($transaksiKas->count() > 0){
          $transaksiKas->delete();    
        } else {
          $transaksiKas = true    ;
        }
          
        if($transaksiKas){
            return true;
        } else {
            return false;
        }

    }
}

