<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class KomisiProduk extends Model
{
    //
    use AuditableTrait;
    protected $fillable = [
            'produk_id','user_id','jumlah_prosentase','jumlah_uang','nama_user',
            'nama_produk','jabatan'
            ];
}
