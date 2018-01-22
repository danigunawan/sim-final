<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiKas extends Model
{
    //
    protected $fillable = ['no_trans','kas','kategori_transaksi','nama_kas','nama_kategori_transaksi'
                            ,'jenis_transaksi','masuk','keluar'];
}
