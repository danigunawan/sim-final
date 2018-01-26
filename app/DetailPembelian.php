<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class DetailPembelian extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['no_trans','pembelian_id','produk','nama_produk',
                           'harga_beli','jumlah','potongan','total'];
}
