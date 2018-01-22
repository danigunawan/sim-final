<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KasMasuk extends Model
{
    //
    protected $fillable = ['no_trans','kas','kategori_transaksi','nama_kas','nama_kategori_transaksi','jumlah','keterangan'];
    
    public static function noKasMasuk(){
     $tahunSekarang = date('Y');
     $bulanSekarang = date('m');
     $tahunTerakhir = substr($tahunSekarang,2);
     $digitBulan = strlen($bulanSekarang);
     if($digitBulan == 1){
       $bulanTerakhir = "0".$bulanSekarang;
     } else {
       $bulanTerakhir = $bulanSekarang;
    }

    $transaksiKasMasuk = KasMasuk::select([DB::raw('MONTH(created_at) bulan'),'no_trans'])
                      ->orderBy('id','DESC')->first();
    if($transaksiKasMasuk != null){
      $angkaNoKasMasuk = explode("/",$transaksiKasMasuk->no_trans);
      $nomor = $angkaNoKasMasuk[0];
      $bulanAkhir = $transaksiKasMasuk->bulan;
    } else {
      $nomor = 1;
      $bulanAkhir = 13;
    }
    if($bulanAkhir != $bulanSekarang ){
      $noKasMasuk = "1/KM/". $bulanTerakhir . "/".$tahunTerakhir;
    } else {
      $nomor++;
      $noKasMasuk = $nomor . "/KM/". $bulanTerakhir ."/". $tahunTerakhir;
    }
    return $noKasMasuk;

   }
}
