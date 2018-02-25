<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingPetugas;

class SettingPetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return SettingPetugas::select('setting_petugas.id','dokters.name AS nama_dokter', 'perawats.name AS nama_perawat', 'farmasis.name AS nama_farmasi')
                              ->leftJoin('users AS dokters','dokters.id','setting_petugas.dokter')
                              ->leftJoin('users AS perawats','perawats.id','setting_petugas.perawat')
                              ->leftJoin('users AS farmasis','farmasis.id','setting_petugas.farmasi')->first();
    }
    public function all()
    {
        //
        return SettingPetugas::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request){
       return SettingPetugas::where('text','LIKE',"%$request->q%")->orWhere('value','LIKE',"%$request->q%")->paginate(10);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return SettingPetugas::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $settingPetugas = SettingPetugas::find($id)->update($request->all());
        if($settingPetugas) {
           return response(200);
        } else {
           return response(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
