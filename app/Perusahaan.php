<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Perusahaan extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['kode','nama','alamat','no_telp'];
}
