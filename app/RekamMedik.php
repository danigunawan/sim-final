<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use Illuminate\Support\Facades\DB;

class RekamMedik extends Model
{
    //
    use AuditableTrait;

    protected $fillable = ['registrasi','sistole_diastole','frekuensi_pernapasan','suhu','nadi','berat_badan',
                            'tinggi_badan','anamnesa','pemeriksaan_fisik','keadaan_umum','kesadaran',
                            'diagnosis_utama','diagnosis_penyerta','diagnosis_penyerta_tambahan','komplikasi','keadaan_pulang'];
}
