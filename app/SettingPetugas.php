<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingPetugas extends Model
{
    //
    protected $fillable = ['dokter','perawat','farmasi'];
}
