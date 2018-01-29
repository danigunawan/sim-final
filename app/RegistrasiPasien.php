<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use Illuminate\Support\Facades\DB;

class RegistrasiPasien extends Model
{
    //
    use AuditableTrait;

    protected $fillable = ['no_reg','pasien','penjamin','dokter','poli','keadaan_umum',
                            'alergi_obat','jenis_registrasi','status_registrasi'];
    public static function noRegistrasiPasien(){
     $tahunSekarang = date('Y');
     $bulanSekarang = date('m');
     $tahunTerakhir = substr($tahunSekarang,2);
     $digitBulan = strlen($bulanSekarang);
     if($digitBulan == 1){
       $bulanTerakhir = "0".$bulanSekarang;
     } else {
       $bulanTerakhir = $bulanSekarang;
    }

    $transaksiRegistrasiPasien = RegistrasiPasien::select([DB::raw('MONTH(created_at) bulan'),'no_reg'])
                      ->orderBy('id','DESC')->first();
    if($transaksiRegistrasiPasien != null){
      $angkaNoRegistrasiPasien = explode("/",$transaksiRegistrasiPasien->no_reg);
      $nomor = $angkaNoRegistrasiPasien[0];
      $bulanAkhir = $transaksiRegistrasiPasien->bulan;
    } else {
      $nomor = 1;
      $bulanAkhir = 13;
    }
    if($bulanAkhir != $bulanSekarang ){
      $noRegistrasiPasien = "1/REG/". $bulanTerakhir . "/".$tahunTerakhir;
    } else {
      $nomor++;
      $noRegistrasiPasien = $nomor . "/REG/". $bulanTerakhir ."/". $tahunTerakhir;
    }
    return $noRegistrasiPasien;

   }
}
