<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class PembayaranPiutang extends Model
{
    //
    use AuditableTrait;

    protected $fillable = ['no_trans_pembayaran','penjamin',
                           'dari_tanggal','jumlah_penjualan_dibayar',
                           'sampai_tanggal','total_pembayaran'];
    public static function noPembayaranPiutang(){
     $tahunSekarang = date('Y');
     $bulanSekarang = date('m');
     $tahunTerakhir = substr($tahunSekarang,2);
     $digitBulan = strlen($bulanSekarang);
     if($digitBulan == 1){
       $bulanTerakhir = "0".$bulanSekarang;
     } else {
       $bulanTerakhir = $bulanSekarang;
    }

    $transaksiPembayaranPiutang = PembayaranPiutang::select([DB::raw('MONTH(created_at) bulan'),'no_trans_pembayaran'])
                      ->orderBy('id','DESC')->first();
    if($transaksiPembayaranPiutang != null){
      $angkaNoPembayaranPiutang = explode("/",$transaksiPembayaranPiutang->no_trans_pembayaran);
      $nomor = $angkaNoPembayaranPiutang[0];
      $bulanAkhir = $transaksiPembayaranPiutang->bulan;
    } else {
      $nomor = 1;
      $bulanAkhir = 13;
    }
    if($bulanAkhir != $bulanSekarang ){
      $noPembayaranPiutang = "1/BP/". $bulanTerakhir . "/".$tahunTerakhir;
    } else {
      $nomor++;
      $noPembayaranPiutang = $nomor . "/BP/". $bulanTerakhir ."/". $tahunTerakhir;
    }
    return $noPembayaranPiutang;

   }
}
