<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Penjamin extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['nama','alamat','no_telp','level_harga'];
}
