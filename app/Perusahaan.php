<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    //
    protected $fillable = ['kode','nama','alamat','no_telp'];
}
