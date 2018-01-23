<?php

namespace App\Observers;

use App\ItemMasuk;
use App\Persediaan;

class ItemMasukObserver
{
    /**
     * Listen to the ItemMasuk created event.
     *
     * @param  \App\ItemMasuk  $itemMasuk
     * @return void
     */
    public function created(ItemMasuk $itemMasuk)
    {
        //
         $transaksiItemMasuk = Persediaan::create(['no_trans' => $itemMasuk->no_trans,
                                                'produk' => $itemMasuk->produk,
                                                'nama_produk' => $itemMasuk->nama_produk,
                                                'harga_pokok' => $itemMasuk->harga_pokok,
                                                'total_nilai' => $itemMasuk->total_nilai,
                                                'masuk' => $itemMasuk->jumlah,
                                                'jenis_transaksi' => 'item_masuk',
                                                'created_at' => $itemMasuk->created_at
                                                ]);

          if($transaksiItemMasuk){
            return true;
          } else {
            return false;
          }
    }


    public function updated(ItemMasuk $itemMasuk){
         Persediaan::where('no_trans',$itemMasuk->no_trans)->delete();
         $transaksiItemMasuk = Persediaan::create(['no_trans' => $itemMasuk->no_trans,
                                                'produk' => $itemMasuk->produk,
                                                'nama_produk' => $itemMasuk->nama_produk,
                                                'harga_pokok' => $itemMasuk->harga_pokok,
                                                'total_nilai' => $itemMasuk->total_nilai,
                                                'masuk' => $itemMasuk->jumlah,
                                                'jenis_transaksi' => 'item_masuk',
                                                'created_at' => $itemMasuk->created_at
                                                ]);
          if($transaksiItemMasuk){
            return true;
          } else {
            return false;
          }
    }

    /**
     * Listen to the ItemMasuk deleting event.
     *
     * @param  \App\ItemMasuk  $itemMasuk
     * @return void
     */
    public function deleting(ItemMasuk $itemMasuk)
    {
        //

        $transaksiItemMasuk = Persediaan::where('no_trans',$itemMasuk->no_trans)->delete();
          
        if($transaksiItemMasuk){
            return true;
        } else {
            return false;
        }

    }
}

