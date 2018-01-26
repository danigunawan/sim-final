<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use Illuminate\Support\Facades\DB;

class Pembelian extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['no_trans','no_faktur_supplier','supplier','nama_supplier',
                            'keterangan','tanggal_jt','potongan',
                            'jumlah_produk','total_nilai','status_beli_awal',
                            'kas','nama_kas',
                            'jumlah_bayar','hutang_awal'];
    public static function noPembelian(){
     $tahunSekarang = date('Y');
     $bulanSekarang = date('m');
     $tahunTerakhir = substr($tahunSekarang,2);
     $digitBulan = strlen($bulanSekarang);
     if($digitBulan == 1){
       $bulanTerakhir = "0".$bulanSekarang;
     } else {
       $bulanTerakhir = $bulanSekarang;
    }

    $transaksiPembelian = Pembelian::select([DB::raw('MONTH(created_at) bulan'),'no_trans'])
                      ->orderBy('id','DESC')->first();
    if($transaksiPembelian != null){
      $angkaNoPembelian = explode("/",$transaksiPembelian->no_trans);
      $nomor = $angkaNoPembelian[0];
      $bulanAkhir = $transaksiPembelian->bulan;
    } else {
      $nomor = 1;
      $bulanAkhir = 13;
    }
    if($bulanAkhir != $bulanSekarang ){
      $noPembelian = "1/BL/". $bulanTerakhir . "/".$tahunTerakhir;
    } else {
      $nomor++;
      $noPembelian = $nomor . "/BL/". $bulanTerakhir ."/". $tahunTerakhir;
    }
    return $noPembelian;

   }
}

