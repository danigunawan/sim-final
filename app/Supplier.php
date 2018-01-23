<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Supplier extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['nama','alamat','no_telp'];
}
