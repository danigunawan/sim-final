<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perusahaan;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Perusahaan::paginate(10);
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
            'nama' => 'required|unique:perusahaans,nama|max:255',
        ]);
        $perusahaan = Perusahaan::create($request->all());
    }

    public function search(Request $request){
       return Perusahaan::where('nama','LIKE',"%$request->q%")->paginate(10);
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
        return Perusahaan::find($id);
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
            'kode' => 'required|unique:perusahaans,kode,'.$id.'|max:255',
            'nama' => 'required|unique:perusahaans,nama,'.$id.'|max:255',
            'alamat' => 'required|unique:perusahaans,alamat,'.$id.'|max:255',
            'no_telp' => 'required|unique:perusahaans,no_telp,'.$id.'|max:255',
        ]);
        $perusahaan = Perusahaan::find($id)->update($request->all());
        if($perusahaan) {
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
        $perusahaan = Perusahaan::destroy($id);
        if($perusahaan){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

