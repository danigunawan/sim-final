<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Ruangan extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['kode','nama','jumlah_kasur'];
}
