<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Persediaan extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['no_trans','produk','nama_produk','harga_pokok',
                            'jenis_transaksi','masuk','keluar','total_nilai','created_at'];
}
