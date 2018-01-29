<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Perusahaan;
use Yajra\Auditable\AuditableTrait;

class Pasien extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['no_rm','nama','jenis_kelamin','alamat',
                           'no_telp','penjamin','kode_perusahaan',
                           'tanggal_lahir', 'alergi_obat'
                           ];

    public static function noRm(){
        
        $perusahaan = Perusahaan::find(1);
        $pasien = Pasien::where('kode_perusahaan',$perusahaan->kode)->orderBy(DB::raw('CONVERT(SUBSTRING(no_rm,5,99),decimal)'),'DESC')->first();
        if($pasien == null){
          $noRm = 0;    
        } else {
          $noRm = $pasien->no_rm;
        }
        $angkaNoRm = str_replace($perusahaan->kode . "-", "", $noRm);
        $noRm = $angkaNoRm + 1;
        $noRm = $perusahaan->kode . "-".$noRm;
        
        return $noRm;
    
    }
}
