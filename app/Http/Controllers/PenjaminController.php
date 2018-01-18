<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjamin;

class PenjaminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Penjamin::paginate(10);
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
            'nama' => 'required|unique:penjamins,nama|max:255',
            'alamat' => 'required|max:255',
            'no_telp' => 'required|numeric',
            'level_harga' => 'required|numeric',
        ]);
        $penjamin = Penjamin::create($request->all());
    }

    public function search(Request $request){
       return Penjamin::where('nama','LIKE',"%$request->q%")
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
        return Penjamin::find($id);
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
            'nama' => 'required|unique:penjamins,nama,'.$id.'|max:255',
            'alamat' => 'required|max:255',
            'no_telp' => 'required|numeric',
            'level_harga' => 'required|numeric',
        ]);
        $penjamin = Penjamin::find($id)->update($request->all());
        if($penjamin) {
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
        $penjamin = Penjamin::destroy($id);
        if($penjamin){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

