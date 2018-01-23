<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KasMutasi;
use App\Kas;
use App\KategoriTransaksi;

class KasMutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return KasMutasi::paginate(10);
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
            'dari_kas' => 'required|numeric',
            'ke_kas' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);
        $dariKas = Kas::find($request->dari_kas);
        $keKas = Kas::find($request->ke_kas);
        $noTrans = KasMutasi::noKasMutasi();
        $request->request->add(['nama_dari_kas' => $dariKas->nama]);
        $request->request->add(['nama_ke_kas' => $keKas->nama]);
        $request->request->add(['no_trans' => $noTrans]);
        $kasMutasi = KasMutasi::create($request->all());
    }

    public function search(Request $request){
       return KasMutasi::where('nama','LIKE',"%$request->q%")
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
        return KasMutasi::find($id);
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
            'dari_kas' => 'required|numeric',
            'ke_kas' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);
        $dariKas = Kas::find($request->dari_kas);
        $keKas = Kas::find($request->ke_kas);
        $request->nama_dari_kas = $dariKas->nama;
        $request->nama_ke_kas =  $keKas->nama;
        $kasMutasi = KasMutasi::find($id)->update($request->all());
        if($kasMutasi) {
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
        $kasMutasi = KasMutasi::destroy($id);
        if($kasMutasi){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

