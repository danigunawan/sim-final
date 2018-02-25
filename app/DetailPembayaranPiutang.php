<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class DetailPembayaranPiutang  extends Model
{
    //
    use AuditableTrait;

    protected $fillable = ['no_trans_pembayaran','no_trans_penjualan','jumlah_bayar'];
}
