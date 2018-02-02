<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class PenjualanPiutang extends Model
{
    //
    use AuditableTrait;

    protected $fillable = ['no_trans','penjamin','jumlah_piutang','akan_dibayar'];
}
