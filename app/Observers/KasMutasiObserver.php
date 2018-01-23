<?php

namespace App\Observers;

use App\KasMutasi;
use App\TransaksiKas;
use App\KategoriTransaksi;

class KasMutasiObserver
{
    /**
     * Listen to the KasMutasi created event.
     *
     * @param  \App\KasMutasi  $kasMutasi
     * @return void
     */
    public function created(KasMutasi $kasMutasi)
    {
        //
          $kategoriTransaksi = KategoriTransaksi::where('nama','Mutasi')->first();
          $transaksiKas = TransaksiKas::create(['no_trans' => $kasMutasi->no_trans,
                                                'kas' => $kasMutasi->ke_kas,
                                                'kategori_transaksi' => $kategoriTransaksi->id,
                                                'nama_kas' => $kasMutasi->nama_ke_kas,
                                                'nama_kategori_transaksi' => $kategoriTransaksi->nama,
                                                'jenis_transaksi' => 'kas_mutasi',
                                                'masuk' => $kasMutasi->jumlah
                                                ]);
          $transaksiKas = TransaksiKas::create(['no_trans' => $kasMutasi->no_trans,
                                                'kas' => $kasMutasi->dari_kas,
                                                'kategori_transaksi' => $kategoriTransaksi->id,
                                                'nama_kas' => $kasMutasi->nama_dari_kas,
                                                'nama_kategori_transaksi' => $kategoriTransaksi->nama,
                                                'jenis_transaksi' => 'kas_mutasi',
                                                'keluar' => $kasMutasi->jumlah
                                                ]);
          if($transaksiKas){
            return true;
          } else {
            return false;
          }
    }


    public function updated(KasMutasi $kasMutasi){
          TransaksiKas::where('no_trans',$kasMutasi->no_trans)->delete();
          $kategoriTransaksi = KategoriTransaksi::where('nama','Mutasi')->first();
          $transaksiKas = TransaksiKas::create(['no_trans' => $kasMutasi->no_trans,
                                                'kas' => $kasMutasi->ke_kas,
                                                'kategori_transaksi' => $kategoriTransaksi->id,
                                                'nama_kas' => $kasMutasi->nama_ke_kas,
                                                'nama_kategori_transaksi' => $kategoriTransaksi->nama,
                                                'jenis_transaksi' => 'kas_mutasi',
                                                'masuk' => $kasMutasi->jumlah
                                                ]);
          $transaksiKas = TransaksiKas::create(['no_trans' => $kasMutasi->no_trans,
                                                'kas' => $kasMutasi->dari_kas,
                                                'kategori_transaksi' => $kategoriTransaksi->id,
                                                'nama_kas' => $kasMutasi->nama_dari_kas,
                                                'nama_kategori_transaksi' => $kategoriTransaksi->nama,
                                                'jenis_transaksi' => 'kas_mutasi',
                                                'keluar' => $kasMutasi->jumlah
                                                ]);
          if($transaksiKas){
            return true;
          } else {
            return false;
          }
    }

    /**
     * Listen to the KasMutasi deleting event.
     *
     * @param  \App\KasMutasi  $kasMutasi
     * @return void
     */
    public function deleting(KasMutasi $kasMutasi)
    {
        //
        $transaksiKas = TransaksiKas::where('no_trans',$kasMutasi->no_trans)->delete();
          
        if($transaksiKas){
            return true;
        } else {
            return false;
        }

    }
}

