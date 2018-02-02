<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class DetailPenjualan extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['no_trans','penjualan_id','produk','nama_produk',
                            'penjamin',
                           'harga_jual','jumlah','potongan','total'];
}
