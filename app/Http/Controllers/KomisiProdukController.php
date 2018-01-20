<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KomisiProduk;
use App\Produk;
use App\User;

class KomisiProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return KomisiProduk::paginate(10);
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
            'user' => 'required|numeric',
            'produk' => 'required|numeric',
            'jumlah_prosentase' => 'required|numeric',
            'jumlah_uang' => 'required|numeric',
        ]);
        $produkId = $request->produk;
        $produk = Produk::find($produkId);
        $userId = $request->user;
        $user = User::find($userId);
        $jumlahProsentase = $request->jumlah_prosentase;
        $jumlahUang = $request->jumlah_uang;

        $komisiProduks = KomisiProduk::create([
                        'user_id' => $userId,
                        'produk_id' => $produkId,
                        'nama_user' => $user->name,
                        'nama_produk' => $produk->nama,
                        'jumlah_prosentase' => $jumlahProsentase,
                        'jumlah_uang' => $jumlahUang,
                        'jabatan' => $user->jabatan
                        ]); 
    }

    public function search(Request $request){
       return KomisiProduk::where('nama_produk','LIKE',"%$request->q%")
                        ->orWhere('nama_user','LIKE',"%$request->q%")
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
        $komisiProduk = KomisiProduk::find($id);
        $komisi = ['produk' => $komisiProduk->produk_id,
                   'user' => $komisiProduk->user_id,
                   'jumlah_prosentase' => $komisiProduk->jumlah_prosentase,
                   'jumlah_uang' => $komisiProduk->jumlah_uang];
        return $komisi;
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
            'user' => 'required|numeric',
            'produk' => 'required|numeric',
            'jumlah_prosentase' => 'required|numeric',
            'jumlah_uang' => 'required|numeric',
        ]);
        $produkId = $request->produk;
        $produk = Produk::find($produkId);
        $userId = $request->user;
        $user = User::find($userId);
        $jumlahProsentase = $request->jumlah_prosentase;
        $jumlahUang = $request->jumlah_uang;

        $komisiProduks = KomisiProduk::find($id)->update([
                        'user_id' => $userId,
                        'produk_id' => $produkId,
                        'nama_user' => $user->name,
                        'nama_produk' => $produk->nama,
                        'jumlah_prosentase' => $jumlahProsentase,
                        'jumlah_uang' => $jumlahUang,
                        'jabatan' => $user->jabatan
                        ]);
        if($komisiProduks) {
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
        $komisiProduks = KomisiProduk::destroy($id);
        if($komisiProduks){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

