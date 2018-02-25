<?php

namespace App\Observers;

use App\Penjualan;
use App\TransaksiKas;
use App\KategoriTransaksi;
use App\PenjualanPiutang;

class PenjualanObserver
{
    /**
     * Listen to the Penjualan created event.
     *
     * @param  \App\Penjualan  $penjualan
     * @return void
     */
    public function created(Penjualan $penjualan)
    {
        //
          //ada tunai nya 
          if($penjualan->jumlah_bayar > 0){
              
            if($penjualan->jumlah_bayar > $penjualan->total_nilai) {
              $jumlah_bayar = $penjualan->total_nilai;
            } else {
              $jumlah_bayar = $penjualan->jumlah_bayar;
            }
            $kategoriTransaksi = KategoriTransaksi::where('nama','Penjualan')->first();
            $transaksiKas = TransaksiKas::create(['no_trans' => $penjualan->no_trans,
                                                  'kas' => $penjualan->kas,
                                                  'kategori_transaksi' => $kategoriTransaksi->id,
                                                  'nama_kas' => $penjualan->nama_kas,
                                                  'nama_kategori_transaksi' => $kategoriTransaksi->nama,
                                                  'jenis_transaksi' => 'penjualan',
                                                  'masuk' => $jumlah_bayar
                                                  ]);
          } else {
           //piutang 
           $transaksiKas = PenjualanPiutang::create(['no_trans' => $penjualan->no_trans,'penjamin' => $penjualan->penjamin,
                                    'jumlah_piutang' => $penjualan->total_nilai_nilai]);

          }

          if($transaksiKas){
            return true;
          } else {
            return false;
          }
    }


    public function updated(Penjualan $penjualan){
          TransaksiKas::where('no_trans',$penjualan->no_trans)->delete();
          if($penjualan->jumlah_bayar > 0){
            if($penjualan->jumlah_bayar > $penjualan->total_nilai) {
              $jumlah_bayar = $penjualan->total_nilai;
            } else {
              $jumlah_bayar = $penjualan->jumlah_bayar;
            }
              
            $kategoriTransaksi = KategoriTransaksi::where('nama','Penjualan')->first();
            $transaksiKas = TransaksiKas::create(['no_trans' => $penjualan->no_trans,
                                                  'kas' => $penjualan->kas,
                                                  'kategori_transaksi' => $kategoriTransaksi->id,
                                                  'nama_kas' => $penjualan->nama_kas,
                                                  'nama_kategori_transaksi' => $kategoriTransaksi->nama,
                                                  'jenis_transaksi' => 'penjualan',
                                                  'masuk' => $jumlah_bayar
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
     * Listen to the Penjualan deleting event.
     *
     * @param  \App\Penjualan  $penjualan
     * @return void
     */
    public function deleting(Penjualan $penjualan)
    {
        //
        $transaksiKas = TransaksiKas::where('no_trans',$penjualan->no_trans);
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

