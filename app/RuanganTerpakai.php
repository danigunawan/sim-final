<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class RuanganTerpakai extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['ruangan','no_reg','status_ruangan'];
}
