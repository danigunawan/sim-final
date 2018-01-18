<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriTransaksi;

class KategoriTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return KategoriTransaksi::paginate(10);
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
            'nama' => 'required|unique:kategori_transaksis,nama|max:255',
        ]);
        $kategoriTransaksi = KategoriTransaksi::create($request->all());
    }

    public function search(Request $request){
       return KategoriTransaksi::where('nama','LIKE',"%$request->q%")->paginate(10);
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
        return KategoriTransaksi::find($id);
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
            'nama' => 'required|unique:kategori_transaksis,nama,'.$id.'|max:255',
        ]);
        $kategoriTransaksi = KategoriTransaksi::find($id)->update($request->all());
        if($kategoriTransaksi) {
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
        $kategoriTransaksi = KategoriTransaksi::destroy($id);
        if($kategoriTransaksi){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

