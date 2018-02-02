<?php

namespace App\Observers;

use App\DetailPenjualan;
use App\Persediaan;

class DetailPenjualanObserver
{
    /**
     * Listen to the DetailPenjualan created event.
     *
     * @param  \App\DetailPenjualan  $detailPenjualan
     * @return void
     */
    public function created(DetailPenjualan $detailPenjualan)
    {
        //
         $transaksiDetailPenjualan = Persediaan::create(['no_trans' => $detailPenjualan->no_trans,
                                                'produk' => $detailPenjualan->produk,
                                                'nama_produk' => $detailPenjualan->nama_produk,
                                                'harga_pokok' => $detailPenjualan->harga_jual,
                                                'total_nilai' => $detailPenjualan->total,
                                                'keluar' => $detailPenjualan->jumlah,
                                                'jenis_transaksi' => 'penjualan',
                                                'created_at' => $detailPenjualan->created_at
                                                ]);

          if($transaksiDetailPenjualan){
            return true;
          } else {
            return false;
          }
    }


    public function updated(DetailPenjualan $detailPenjualan){
         Persediaan::where('no_trans',$detailPenjualan->no_trans)->delete();
         $transaksiDetailPenjualan = Persediaan::create(['no_trans' => $detailPenjualan->no_trans,
                                                'produk' => $detailPenjualan->produk,
                                                'nama_produk' => $detailPenjualan->nama_produk,
                                                'harga_pokok' => $detailPenjualan->harga_jual,
                                                'total_nilai' => $detailPenjualan->total,
                                                'keluar' => $detailPenjualan->jumlah,
                                                'jenis_transaksi' => 'penjualan',
                                                'created_at' => $detailPenjualan->created_at
                                                ]);
          if($transaksiDetailPenjualan){
            return true;
          } else {
            return false;
          }
    }

    /**
     * Listen to the DetailPenjualan deleting event.
     *
     * @param  \App\DetailPenjualan  $detailPenjualan
     * @return void
     */
    public function deleting(DetailPenjualan $detailPenjualan)
    {
        //

        $transaksiDetailPenjualan = Persediaan::where('no_trans',$detailPenjualan->no_trans)->delete();
          
        if($transaksiDetailPenjualan){
            return true;
        } else {
            return false;
        }

    }
}

