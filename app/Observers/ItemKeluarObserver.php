<?php

namespace App\Observers;

use App\ItemKeluar;
use App\Persediaan;

class ItemKeluarObserver
{
    /**
     * Listen to the ItemKeluar created event.
     *
     * @param  \App\ItemKeluar  $itemKeluar
     * @return void
     */
    public function created(ItemKeluar $itemKeluar)
    {
        //
         $transaksiItemKeluar = Persediaan::create(['no_trans' => $itemKeluar->no_trans,
                                                'produk' => $itemKeluar->produk,
                                                'nama_produk' => $itemKeluar->nama_produk,
                                                'harga_pokok' => $itemKeluar->harga_pokok,
                                                'total_nilai' => $itemKeluar->total_nilai,
                                                'keluar' => $itemKeluar->jumlah,
                                                'jenis_transaksi' => 'item_keluar',
                                                'created_at' => $itemKeluar->created_at
                                                ]);

          if($transaksiItemKeluar){
            return true;
          } else {
            return false;
          }
    }


    public function updated(ItemKeluar $itemKeluar){
         Persediaan::where('no_trans',$itemKeluar->no_trans)->delete();
         $transaksiItemKeluar = Persediaan::create(['no_trans' => $itemKeluar->no_trans,
                                                'produk' => $itemKeluar->produk,
                                                'nama_produk' => $itemKeluar->nama_produk,
                                                'harga_pokok' => $itemKeluar->harga_pokok,
                                                'total_nilai' => $itemKeluar->total_nilai,
                                                'keluar' => $itemKeluar->jumlah,
                                                'jenis_transaksi' => 'item_keluar',
                                                'created_at' => $itemKeluar->created_at
                                                ]);
          if($transaksiItemKeluar){
            return true;
          } else {
            return false;
          }
    }

    /**
     * Listen to the ItemKeluar deleting event.
     *
     * @param  \App\ItemKeluar  $itemKeluar
     * @return void
     */
    public function deleting(ItemKeluar $itemKeluar)
    {
        //

        $transaksiItemKeluar = Persediaan::where('no_trans',$itemKeluar->no_trans)->delete();
          
        if($transaksiItemKeluar){
            return true;
        } else {
            return false;
        }

    }
}

