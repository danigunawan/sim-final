<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ruangan;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        return Ruangan::paginate(10);
    }

    public function all() {
        //
        return Ruangan::all();
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
            'nama' => 'required|unique:ruangans,nama|max:255',
            'kode' => 'required|unique:ruangans,nama|max:255',
            'jumlah_kasur' => 'required|numeric',
        ]);
        $ruangan = Ruangan::create($request->all());
    }

    public function search(Request $request){
       return Ruangan::where('nama','LIKE',"%$request->q%")->paginate(10);
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
        return Ruangan::find($id);
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
            'nama' => 'required|unique:ruangans,nama,'.$id.'|max:255',
            'kode' => 'required|unique:ruangans,nama,'.$id.'|max:255',
            'jumlah_kasur' => 'required|numeric',
        ]);
        $ruangan = Ruangan::find($id)->update($request->all());
        if($ruangan) {
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
        $ruangan = Ruangan::destroy($id);
        if($ruangan){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

