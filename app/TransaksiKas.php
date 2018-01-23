<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class TransaksiKas extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['no_trans','kas','kategori_transaksi','nama_kas','nama_kategori_transaksi'
                            ,'jenis_transaksi','masuk','keluar'];
}
