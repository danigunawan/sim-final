<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class TbsEditPembelian extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['produk','nama_produk','no_trans','pembelian_id',
                           'harga_beli','jumlah','potongan','total'];
}
