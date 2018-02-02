<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use Illuminate\Support\Facades\DB;

class Penjualan extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['no_trans','tanggal_jt','potongan',
                            'no_reg','jenis_penjualan',
                            'penjamin','nama_penjamin',
                            'jumlah_produk','total_nilai','status_jual_awal',
                            'kas','nama_kas',
                            'jumlah_bayar','piutang_awal'];
    public static function noPenjualan(){
     $tahunSekarang = date('Y');
     $bulanSekarang = date('m');
     $tahunTerakhir = substr($tahunSekarang,2);
     $digitBulan = strlen($bulanSekarang);
     if($digitBulan == 1){
       $bulanTerakhir = "0".$bulanSekarang;
     } else {
       $bulanTerakhir = $bulanSekarang;
    }

    $transaksiPenjualan = Penjualan::select([DB::raw('MONTH(created_at) bulan'),'no_trans'])
                      ->orderBy('id','DESC')->first();
    if($transaksiPenjualan != null){
      $angkaNoPenjualan = explode("/",$transaksiPenjualan->no_trans);
      $nomor = $angkaNoPenjualan[0];
      $bulanAkhir = $transaksiPenjualan->bulan;
    } else {
      $nomor = 1;
      $bulanAkhir = 13;
    }
    if($bulanAkhir != $bulanSekarang ){
      $noPenjualan = "1/JL/". $bulanTerakhir . "/".$tahunTerakhir;
    } else {
      $nomor++;
      $noPenjualan = $nomor . "/JL/". $bulanTerakhir ."/". $tahunTerakhir;
    }
    return $noPenjualan;

   }
}

