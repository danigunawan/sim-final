<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Produk::paginate(10);
    }

    public function all()
    {
        //
        return Produk::all();
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
            'kode' => 'required|unique:produks,kode|max:255',
            'nama' => 'required|unique:produks,nama|max:255',
            'kategori_produk' => 'required|numeric',
            'satuan' => 'required|numeric',
            'tipe_produk' => 'required|max:255',
            'harga_beli' => 'required|numeric',
            'harga_jual_1' => 'required|numeric',
            'harga_jual_2' => 'nullable|numeric',
            'harga_jual_3' => 'nullable|numeric',
        ]);
        $supplier = Produk::create($request->all());
    }

    public function search(Request $request){
       return Produk::where('nama','LIKE',"%$request->q%")
                        ->orWhere('kode',$request->q)
                        ->paginate(10);
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
        return Produk::find($id);
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
            'kode' => 'required|unique:produks,kode,'.$id.'|max:255',
            'nama' => 'required|unique:produks,nama,'.$id.'|max:255',
            'kategori_produk' => 'required|numeric',
            'satuan' => 'required|numeric',
            'tipe_produk' => 'required|max:255',
            'harga_beli' => 'required|numeric',
            'harga_jual_1' => 'required|numeric',
            'harga_jual_2' => 'nullable|numeric',
            'harga_jual_3' => 'nullable|numeric',
        ]);
        $supplier = Produk::find($id)->update($request->all());
        if($supplier) {
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
        $supplier = Produk::destroy($id);
        if($supplier){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

