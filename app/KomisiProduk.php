<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomisiProduk extends Model
{
    //
    protected $fillable = [
            'produk_id','user_id','jumlah_prosentase','jumlah_uang','nama_user',
            'nama_produk','jabatan'
            ];
}
