<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Produk extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['kode','nama','kategori_produk','harga_beli','harga_jual_1',
                            'harga_jual_2','harga_jual_3',
                            'satuan','tipe_produk'];
}
