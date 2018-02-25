<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class DetailKomisiProduk extends Model
{
    //
    use AuditableTrait;

    protected $fillable = ['no_reg','no_trans','komisi_id','user_id','produk_id','nominal_komisi'];
}
