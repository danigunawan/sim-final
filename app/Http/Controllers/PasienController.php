<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasien;
use App\Perusahaan;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Pasien::leftJoin('penjamins','pasiens.penjamin','penjamins.id')
                       ->select('pasiens.*','penjamins.nama AS nama_penjamin')->paginate(10);
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
    public function store(Request $request)
    {
        //

        $request->validate([
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'no_telp' => 'required|max:255',
            'penjamin' => 'required|numeric',
            'jenis_kelamin' => 'required',
        ]);
        $noRm = Pasien::noRm();
        $perusahaan = Perusahaan::find(1);
        $pasien = Pasien::create(['no_rm' => $noRm,'nama' => $request->nama,
                                  'alamat' => $request->alamat,'no_telp' => $request->no_telp,
                                  'penjamin' => $request->penjamin,
                                  'jenis_kelamin' => $request->jenis_kelamin,
                                  'kode_perusahaan' => $perusahaan->kode,
                                  'tanggal_lahir' => $request->tanggal_lahir]);
        if($pasien) {
           return response(200);
        } else {
           return response(500);
        }
    }

    public function search(Request $request){
       return Pasien::where('nama','LIKE',"%$request->q%")
                     ->orWhere('no_rm',$request->q)
                     ->orWhere('no_telp',$request->q)
                     ->orWhere('alamat','LIKE',"%$request->q%")
                     ->paginate(10);
    }
    //pencarian ini digunakan di registrasi pasien
    public function pencarianRegistrasi(Request $request){
       if(isset($request->nama) && isset($request->no_rm) && isset($request->tanggal_lahir)){
           $pasien = Pasien::where('nama','LIKE',"%$request->nama%")
                     ->where('no_rm',$request->no_rm)
                     ->where('tanggal_lahir',$request->tanggal_lahir)
                     ->paginate(10);
       } else if(isset($request->nama) && isset($request->no_rm) && !isset($request->tanggal_lahir)){
           $pasien = Pasien::where('nama','LIKE',"%$request->nama%")
                     ->where('no_rm',$request->no_rm)
                     ->paginate(10);
       } else if(isset($request->nama) && !isset($request->no_rm) && !isset($request->tanggal_lahir)){
           $pasien = Pasien::where('nama','LIKE',"%$request->nama%")
                     ->paginate(10);
       } else if(!isset($request->nama) && isset($request->no_rm) && !isset($request->tanggal_lahir)){
           $pasien = Pasien::where('no_rm',$request->no_rm)
                     ->paginate(10);
       } else if(!isset($request->nama) && !isset($request->no_rm) && isset($request->tanggal_lahir)){
           $pasien = Pasien::where('tanggal_lahir',$request->tanggal_lahir)
                     ->paginate(10);
       } else if(!isset($request->nama) && isset($request->no_rm) && isset($request->tanggal_lahir)){
           $pasien = Pasien::where('tanggal_lahir',$request->tanggal_lahir)
                     ->where('no_rm',$request->no_rm)
                     ->paginate(10);
       } else if(isset($request->nama) && !isset($request->no_rm) && isset($request->tanggal_lahir)){
           $pasien = Pasien::where('nama','LIKE',"%$request->nama%")
                     ->where('tanggal_lahir',$request->tanggal_lahir)
                     ->paginate(10);
       }
       return $pasien;
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
        return Pasien::find($id);
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
        $request->validate([
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'no_telp' => 'required|max:255',
            'penjamin' => 'required|numeric',
        ]);
        $pasien = Pasien::find($id)->update($request->all());
        if($pasien) {
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
        $pasien = Pasien::destroy($id);
        if($pasien){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

