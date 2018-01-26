<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class TbsPembelian extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['produk','nama_produk',
                           'harga_beli','jumlah','potongan','total'];
}
