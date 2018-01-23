<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Satuan extends Model
{
    //
    use AuditableTrait;
   protected $fillable = ['nama'];
}
