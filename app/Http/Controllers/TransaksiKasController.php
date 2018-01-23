<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiKas;

class TransaksiKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporan(Request $request)
    {
        //
        return TransaksiKas::where('kas',$request->kas)->where(function($query) use ($request){
             $query->whereDate('created_at','>=',$request->dariTanggal)
                    ->whereDate('created_at','<=',$request->sampaiTanggal) ;
            })->paginate(10);
    }

}

