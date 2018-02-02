<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class TbsPenjualan extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['produk','nama_produk',
                            'penjamin',
                           'harga_jual','jumlah','potongan','total'];
}
