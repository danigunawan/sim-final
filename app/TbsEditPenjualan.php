<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class TbsEditPenjualan extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['produk','nama_produk','no_trans','penjualan_id',
                            'penjamin',
                           'harga_jual','jumlah','potongan','total','no_reg'];
}
