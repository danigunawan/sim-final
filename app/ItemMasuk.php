<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use Illuminate\Support\Facades\DB;

class ItemMasuk extends Model
{
    //
    use AuditableTrait;

    protected $fillable = ['no_trans','produk','nama_produk','harga_pokok','jumlah','total_nilai'];
    public static function noItemMasuk(){
     $tahunSekarang = date('Y');
     $bulanSekarang = date('m');
     $tahunTerakhir = substr($tahunSekarang,2);
     $digitBulan = strlen($bulanSekarang);
     if($digitBulan == 1){
       $bulanTerakhir = "0".$bulanSekarang;
     } else {
       $bulanTerakhir = $bulanSekarang;
    }

    $transaksiItemMasuk = ItemMasuk::select([DB::raw('MONTH(created_at) bulan'),'no_trans'])
                      ->orderBy('id','DESC')->first();
    if($transaksiItemMasuk != null){
      $angkaNoItemMasuk = explode("/",$transaksiItemMasuk->no_trans);
      $nomor = $angkaNoItemMasuk[0];
      $bulanAkhir = $transaksiItemMasuk->bulan;
    } else {
      $nomor = 1;
      $bulanAkhir = 13;
    }
    if($bulanAkhir != $bulanSekarang ){
      $noItemMasuk = "1/IM/". $bulanTerakhir . "/".$tahunTerakhir;
    } else {
      $nomor++;
      $noItemMasuk = $nomor . "/IM/". $bulanTerakhir ."/". $tahunTerakhir;
    }
    return $noItemMasuk;

   }
}
