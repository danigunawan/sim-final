<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Kas;
use App\KategoriTransaksi;
use App\Produk;
use App\Supplier;
use App\TbsPembelian;
use App\TbsEditPembelian;
use App\DetailPembelian;
use Auth;
use App\Persediaan;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Pembelian::paginate(10);
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
    public function createDetailPembelian(){
        
        return TbsPembelian::where('created_by',Auth::user()->id)->get();
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
            'total_nilai' => 'required|numeric',
            'kas' => 'nullable|numeric',
            'supplier' => 'required|numeric',
            'jumlah_bayar' => 'nullable|numeric',
            'hutang_awal' => 'nullable|numeric',
        ]);
        if($request->hutang_awal > 0){
          $statusBeliAwal = 'hutang';
        } else {
          $statusBeliAwal = 'tunai';    
        }
        $jumlahProduk = count($request->detailPembelian);
        $kas = Kas::find($request->kas);
        $supplier = Supplier::find($request->supplier);
        $noTrans = Pembelian::noPembelian();
        $request->request->add(['no_trans' => $noTrans]);
        $request->request->add(['status_beli_awal' => $statusBeliAwal]);
        $request->request->add(['jumlah_produk' => $jumlahProduk]);
        $request->request->add(['nama_kas' => $kas->nama]);
        $request->request->add(['nama_supplier' => $supplier->nama]);
        $pembelian = Pembelian::create($request->all());
        $detailPembelian = $this->storeDetailPembelian($request,$noTrans,$pembelian->id);
        if($pembelian){
          return response(200);    
        } else {
          return response(500);    
        }

    }
    public function storeDetailPembelian($request,$noTrans,$id){
       $detailPembelianSebelumnya = DetailPembelian::where('pembelian_id',$id);
       if($detailPembelianSebelumnya->count() > 0){
         foreach($detailPembelianSebelumnya->get() as $detailDelete){
            DetailPembelian::destroy($detailDelete->id);    
         }
       }
        $detailPembelian = $request->detailPembelian;
        foreach($detailPembelian as $detail ){
           $detail['no_trans'] = $noTrans;
           $detail['pembelian_id'] = $id;
           DetailPembelian::create($detail);
        }
        TbsPembelian::where('created_by',Auth::user()->id)->delete();
        return true;
        
    }

    public function storeTbsPembelian(Request $request){
        
        $request->validate([
            'produk' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);
        $produk = Produk::find($request->produk);
        $totalNilai = $request->jumlah * $produk->harga_beli;
        $request->request->add(['nama_produk' => $produk->nama]);
        $request->request->add(['harga_beli' => $produk->harga_beli]);
        $request->request->add(['total' => $totalNilai]);
        $getTbsPembelian = TbsPembelian::where('produk',$request->produk)->count();
        if($getTbsPembelian > 0){
          $tbsPembelian = $this->updateTbsPembelian($request);
        } else {    
          $tbsPembelian = TbsPembelian::create($request->all());
        }

        if($tbsPembelian){
          return response(200) ;    
        } else {
          return response(500);    
        }
    }

    public function storeTbsEditPembelian(Request $request,$id){
        
        $request->validate([
            'produk' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);
        $pembelian = Pembelian::find($id);
        $produk = Produk::find($request->produk);
        $totalNilai = $request->jumlah * $produk->harga_beli;
        $request->request->add(['nama_produk' => $produk->nama]);
        $request->request->add(['no_trans' => $pembelian->no_trans]);
        $request->request->add(['pembelian_id' => $id]);
        $request->request->add(['harga_beli' => $produk->harga_beli]);
        $request->request->add(['total' => $totalNilai]);
        $getTbsEditPembelian = TbsEditPembelian::where('produk',$request->produk)
                                ->where('pembelian_id',$id)
                                ->where('created_by',Auth::user()->id)->count();
        if($getTbsEditPembelian > 0){
          $tbsEditPembelian = $this->updateTbsEditPembelian($request);
        } else {    
          $tbsEditPembelian = TbsEditPembelian::create($request->all());
        }

        if($tbsEditPembelian){
          return response(200) ;    
        } else {
          return response(500);    
        }
    }

    public function updateTbsPembelian($request){
        
        $updateTbsPembelian = TbsPembelian::where('produk',$request->produk)
                                ->update($request->all());
        if($updateTbsPembelian){
          return true;
        } else {
          return false;    
        }
    }

    public function updateTbsEditPembelian($request,$id){
        
        $updateTbsEditPembelian = TbsEditPembelian::where('produk',$request->produk)
                                ->where('pembelian_id',$id)
                                ->where('created_by',Auth::user()->id)
                                ->update($request->all());
        if($updateTbsEditPembelian){
          return true;
        } else {
          return false;    
        }
    }

    public function search(Request $request){
       return Pembelian::where('nama','LIKE',"%$request->q%")
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
        return Pembelian::find($id);
    }
   /*
    function editDetailPembelian ini di jalankan ketika form pertama
    kali di akses (mounted)
    data dari detail dimasukan ke edit tbs
   */
    public function editDetailPembelian($id){
           TbsEditPembelian::where('pembelian_id',$id)->where('created_by',Auth::user()->id)->delete();
           $detailPembelian = DetailPembelian::where('pembelian_id',$id)->get()->toArray();
           foreach($detailPembelian as $detail){

             TbsEditPembelian::create($detail);    
           }

           return TbsEditPembelian::where('pembelian_id',$id)->get();
         
    }
    // function editTbsPembelian ini dijalankan ketika ada penambahkan produk, dan penghapusan produk
    public function editTbsPembelian($id){
        
           return TbsEditPembelian::where('pembelian_id',$id)->get();
        
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
            'total_nilai' => 'required|numeric',
            'kas' => 'nullable|numeric',
            'supplier' => 'required|numeric',
            'jumlah_bayar' => 'nullable|numeric',
            'hutang_awal' => 'nullable|numeric',
        ]);
        if($request->hutang_awal > 0){
          $statusBeliAwal = 'hutang';
        } else {
          $statusBeliAwal = 'tunai';    
        }
        $jumlahProduk = count($request->detailPembelian);
        $kas = Kas::find($request->kas);
        $supplier = Supplier::find($request->supplier);

        $request->request->add(['status_beli_awal' => $statusBeliAwal]);
        $request->request->add(['jumlah_produk' => $jumlahProduk]);
        $request->request->add(['nama_kas' => $kas->nama]);
        $request->request->add(['nama_supplier' => $supplier->nama]);

        $pembelian = Pembelian::find($id)->update($request->all());
        $detailPembelian = $this->storeDetailPembelian($request,$request->no_trans,$id);
        if($pembelian) {
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
        $pembelian = Pembelian::find($id);
        $pembelianDestroy = Pembelian::destroy($id);
        Persediaan::where('no_trans',$pembelian->no_trans)->delete();
           
        if($pembelianDestroy){
          return response(200);
        } else {
          return response(500);    
        }
    }
    
    public function deleteTbsPembelian($id){
      $tbsPembelian = TbsPembelian::destroy($id);    
        if($tbsPembelian){
          return response(200);
        } else {
          return response(500);    
        }
    }

    public function deleteTbsEditPembelian($id){
      $tbsEditPembelian = TbsEditPembelian::destroy($id);    
        if($tbsEditPembelian){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

