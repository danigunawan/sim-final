<?php

namespace App\Observers;

use App\DetailPembelian;
use App\Persediaan;

class DetailPembelianObserver
{
    /**
     * Listen to the DetailPembelian created event.
     *
     * @param  \App\DetailPembelian  $detailPembelian
     * @return void
     */
    public function created(DetailPembelian $detailPembelian)
    {
        //
         $transaksiDetailPembelian = Persediaan::create(['no_trans' => $detailPembelian->no_trans,
                                                'produk' => $detailPembelian->produk,
                                                'nama_produk' => $detailPembelian->nama_produk,
                                                'harga_pokok' => $detailPembelian->harga_beli,
                                                'total_nilai' => $detailPembelian->total,
                                                'masuk' => $detailPembelian->jumlah,
                                                'jenis_transaksi' => 'detailPembelian',
                                                'created_at' => $detailPembelian->created_at
                                                ]);

          if($transaksiDetailPembelian){
            return true;
          } else {
            return false;
          }
    }


    public function updated(DetailPembelian $detailPembelian){
         Persediaan::where('no_trans',$detailPembelian->no_trans)->delete();
         $transaksiDetailPembelian = Persediaan::create(['no_trans' => $detailPembelian->no_trans,
                                                'produk' => $detailPembelian->produk,
                                                'nama_produk' => $detailPembelian->nama_produk,
                                                'harga_pokok' => $detailPembelian->harga_beli,
                                                'total_nilai' => $detailPembelian->total,
                                                'masuk' => $detailPembelian->jumlah,
                                                'jenis_transaksi' => 'detailPembelian',
                                                'created_at' => $detailPembelian->created_at
                                                ]);
          if($transaksiDetailPembelian){
            return true;
          } else {
            return false;
          }
    }

    /**
     * Listen to the DetailPembelian deleting event.
     *
     * @param  \App\DetailPembelian  $detailPembelian
     * @return void
     */
    public function deleting(DetailPembelian $detailPembelian)
    {
        //

        $transaksiDetailPembelian = Persediaan::where('no_trans',$detailPembelian->no_trans)->delete();
          
        if($transaksiDetailPembelian){
            return true;
        } else {
            return false;
        }

    }
}

