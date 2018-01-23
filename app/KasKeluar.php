<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Yajra\Auditable\AuditableTrait;

class KasKeluar extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['no_trans','kas','kategori_transaksi','nama_kas','nama_kategori_transaksi','jumlah','keterangan'];
    
    public static function noKasKeluar(){
     $tahunSekarang = date('Y');
     $bulanSekarang = date('m');
     $tahunTerakhir = substr($tahunSekarang,2);
     $digitBulan = strlen($bulanSekarang);
     if($digitBulan == 1){
       $bulanTerakhir = "0".$bulanSekarang;
     } else {
       $bulanTerakhir = $bulanSekarang;
    }

    $transaksiKasKeluar = KasKeluar::select([DB::raw('MONTH(created_at) bulan'),'no_trans'])
                      ->orderBy('id','DESC')->first();
    if($transaksiKasKeluar != null){
      $angkaNoKasKeluar = explode("/",$transaksiKasKeluar->no_trans);
      $nomor = $angkaNoKasKeluar[0];
      $bulanAkhir = $transaksiKasKeluar->bulan;
    } else {
      $nomor = 1;
      $bulanAkhir = 13;
    }
    if($bulanAkhir != $bulanSekarang ){
      $noKasKeluar = "1/KK/". $bulanTerakhir . "/".$tahunTerakhir;
    } else {
      $nomor++;
      $noKasKeluar = $nomor . "/KK/". $bulanTerakhir ."/". $tahunTerakhir;
    }
    return $noKasKeluar;

   }
}
