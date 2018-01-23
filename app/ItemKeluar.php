<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use Illuminate\Support\Facades\DB;

class ItemKeluar extends Model
{
    //
    use AuditableTrait;

    protected $fillable = ['no_trans','produk','nama_produk','harga_pokok','jumlah','total_nilai'];
    public static function noItemKeluar(){
     $tahunSekarang = date('Y');
     $bulanSekarang = date('m');
     $tahunTerakhir = substr($tahunSekarang,2);
     $digitBulan = strlen($bulanSekarang);
     if($digitBulan == 1){
       $bulanTerakhir = "0".$bulanSekarang;
     } else {
       $bulanTerakhir = $bulanSekarang;
    }

    $transaksiItemKeluar = ItemKeluar::select([DB::raw('MONTH(created_at) bulan'),'no_trans'])
                      ->orderBy('id','DESC')->first();
    if($transaksiItemKeluar != null){
      $angkaNoItemKeluar = explode("/",$transaksiItemKeluar->no_trans);
      $nomor = $angkaNoItemKeluar[0];
      $bulanAkhir = $transaksiItemKeluar->bulan;
    } else {
      $nomor = 1;
      $bulanAkhir = 13;
    }
    if($bulanAkhir != $bulanSekarang ){
      $noItemKeluar = "1/IK/". $bulanTerakhir . "/".$tahunTerakhir;
    } else {
      $nomor++;
      $noItemKeluar = $nomor . "/IK/". $bulanTerakhir ."/". $tahunTerakhir;
    }
    return $noItemKeluar;

   }
}
