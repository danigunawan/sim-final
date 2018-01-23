<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemKeluar;
use App\Kas;
use App\KategoriTransaksi;
use App\Produk;

class ItemKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ItemKeluar::paginate(10);
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
            'produk' => 'required|numeric',
            'harga_pokok' => 'nullable|numeric',
            'jumlah' => 'required|numeric',
        ]);
        $produk = Produk::find($request->produk);
        $noTrans = ItemKeluar::noItemKeluar();
        if($produk->harga_pokok != ''){
          $totalNilai = $produk->harga_pokok * $request->jumlah;
        } else {
          $totalNilai = $request->jumlah * $produk->harga_beli;    
        }
        $request->request->add(['nama_produk' => $produk->nama]);
        $request->request->add(['no_trans' => $noTrans]);
        $request->request->add(['total_nilai' => $totalNilai]);
        $request->request->add(['harga_pokok' => $produk->harga_pokok]);
        $itemKeluar = ItemKeluar::create($request->all());
    }

    public function search(Request $request){
       return ItemKeluar::where('nama','LIKE',"%$request->q%")
                        ->orWhere('alamat','LIKE',"%$request->q%")
                        ->orWhere('no_telp','LIKE',"%$request->q%")
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
        return ItemKeluar::find($id);
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
            'produk' => 'required|numeric',
            'harga_pokok' => 'nullable|numeric',
            'jumlah' => 'required|numeric',
        ]);
        $produk = Produk::find($request->produk);
        if($produk->harga_pokok != ''){
          $totalNilai = $produk->harga_pokok * $request->jumlah;
        } else {
          $totalNilai = $request->jumlah * $produk->harga_beli;    
        }
        $request->request->add(['nama_produk' => $produk->nama]);
        $request->request->add(['total_nilai' => $totalNilai]);
        $itemKeluar = ItemKeluar::find($id)->update($request->all());
        if($itemKeluar) {
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
        $itemKeluar = ItemKeluar::destroy($id);
        if($itemKeluar){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

