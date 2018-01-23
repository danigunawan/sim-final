<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Yajra\Auditable\AuditableTrait;

class KasMutasi extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['no_trans','dari_kas','ke_kas','nama_dari_kas','nama_ke_kas','jumlah','keterangan'];
    
    public static function noKasMutasi(){
     $tahunSekarang = date('Y');
     $bulanSekarang = date('m');
     $tahunTerakhir = substr($tahunSekarang,2);
     $digitBulan = strlen($bulanSekarang);
     if($digitBulan == 1){
       $bulanTerakhir = "0".$bulanSekarang;
     } else {
       $bulanTerakhir = $bulanSekarang;
    }

    $transaksiKasMutasi = KasMutasi::select([DB::raw('MONTH(created_at) bulan'),'no_trans'])
                      ->orderBy('id','DESC')->first();
    if($transaksiKasMutasi != null){
      $angkaNoKasMutasi = explode("/",$transaksiKasMutasi->no_trans);
      $nomor = $angkaNoKasMutasi[0];
      $bulanAkhir = $transaksiKasMutasi->bulan;
    } else {
      $nomor = 1;
      $bulanAkhir = 13;
    }
    if($bulanAkhir != $bulanSekarang ){
      $noKasMutasi = "1/KMT/". $bulanTerakhir . "/".$tahunTerakhir;
    } else {
      $nomor++;
      $noKasMutasi = $nomor . "/KMT/". $bulanTerakhir ."/". $tahunTerakhir;
    }
    return $noKasMutasi;

   }
}
