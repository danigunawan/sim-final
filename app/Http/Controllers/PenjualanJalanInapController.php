<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\Kas;
use App\KategoriTransaksi;
use App\Produk;
use App\Penjamin;
use App\TbsPenjualan;
use App\TbsEditPenjualan;
use App\DetailPenjualan;
use App\Persediaan;
use Auth;
use App\KomisiProduk;
use App\TbsKomisiProduk;
use App\DetailKomisiProduk;
use App\RegistrasiPasien;

class PenjualanJalanInapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Penjualan::where('jenis_penjualan','jalan_inap')->paginate(10);
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
    public function createDetailPenjualan($no_reg){
      $komisiProduk = TbsKomisiProduk::select('users.name AS user_name','produks.nama AS produk_name','nominal_komisi')
                                        ->leftJoin('users','tbs_komisi_produks.user_id','users.id')
                                        ->leftJoin('produks','tbs_komisi_produks.produk_id','produks.id')
                                        ->where('no_reg',$no_reg)->get();
      $tbsPenjualan = TbsPenjualan::where('no_reg',$no_reg)->get();
      $objetToReturn = ['komisi_produk' => $komisiProduk,'tbs_penjualan' => $tbsPenjualan];
      return $objetToReturn;
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
            'penjamin' => 'required|numeric',
            'jumlah_bayar' => 'nullable|numeric',
            'piutang_awal' => 'nullable|numeric',
        ]);
        if($request->piutang_awal > 0){
          $statusBeliAwal = 'piutang';
        } else {
          $statusBeliAwal = 'tunai';
        }
        $jumlahProduk = count($request->detailPenjualanJalanInap);
        $kas = Kas::find($request->kas);
        $penjamin = Penjamin::find($request->penjamin);
        $noTrans = Penjualan::noPenjualan();
        $request->request->add(['no_trans' => $noTrans]);
        $request->request->add(['status_jual_awal' => $statusBeliAwal]);
        $request->request->add(['jumlah_produk' => $jumlahProduk]);
        $request->request->add(['nama_kas' => $kas->nama]);
        $request->request->add(['nama_penjamin' => $penjamin->nama]);
        $request->request->add(['jenis_penjualan' => 'jalan_inap']);
        $penjualan = Penjualan::create($request->all());
        $detailPenjualan = $this->storeDetailPenjualan($request,$noTrans,$penjualan->id);
        $detailKomisiProduk = $this->storeDetailKomisiProduk($request->no_reg,$noTrans);
        RegistrasiPasien::where('no_reg',$request->no_reg)->update(['status_registrasi' => 'selesai']);
        if($penjualan){
          return response(200);
        } else {
          return response(500);
        }

    }
    public function storeDetailPenjualan($request,$noTrans,$id){
       $detailPenjualanSebelumnya = DetailPenjualan::where('penjualan_id',$id);
       if($detailPenjualanSebelumnya->count() > 0){
         foreach($detailPenjualanSebelumnya->get() as $detailDelete){
            DetailPenjualan::destroy($detailDelete->id);
         }
       }
        $detailPenjualan = $request->detailPenjualanJalanInap;
        foreach($detailPenjualan as $detail ){
           $detail['no_trans'] = $noTrans;
           $detail['penjualan_id'] = $id;
           DetailPenjualan::create($detail);
        }
        TbsPenjualan::where('created_by',Auth::user()->id)->delete();
        return true;

    }

    public function storeTbsPenjualan(Request $request){

        $request->validate([
            'produk' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'penjamin' => 'required|numeric',
        ]);
        $produk = Produk::find($request->produk);
        $penjamin = Penjamin::find($request->penjamin);
        if($penjamin->level_harga == '1'){
          $totalNilai = $request->jumlah * $produk->harga_jual_1;
          $request->request->add(['harga_jual' => $produk->harga_jual_1]);
        } else if($penjamin->level_harga == '2'){
          $totalNilai = $request->jumlah * $produk->harga_jual_2;
          $request->request->add(['harga_jual' => $produk->harga_jual_2]);
        } else if($penjamin->level_harga == '3'){
          $totalNilai = $request->jumlah * $produk->harga_jual_3;
          $request->request->add(['harga_jual' => $produk->harga_jual_3]);
        }
        $request->request->add(['nama_produk' => $produk->nama]);
        $request->request->add(['total' => $totalNilai]);
        $getTbsPenjualan = TbsPenjualan::where('produk',$request->produk)
                                        ->where('no_reg',$request->no_reg)->count();
        if($getTbsPenjualan > 0){
          $tbsPenjualan = $this->updateTbsPenjualan($request);
        } else {
          $tbsPenjualan = TbsPenjualan::create($request->all());
          $this->storeTbsKomisiProduk($request->dokter,$request->produk,$request->no_reg);
          $this->storeTbsKomisiProduk($request->paramedik,$request->produk,$request->no_reg);
          $this->storeTbsKomisiProduk($request->farmasi,$request->produk,$request->no_reg);
        }

        if($tbsPenjualan){
          return response(200) ;
        } else {
          return response(500);
        }
    }
    private function storeTbsKomisiProduk($petugas,$produk,$no_reg){
      if($produk != ''){
        $komisiProduk = KomisiProduk::where('produk_id',$produk)
                        ->where('user_id',$petugas);
        if($komisiProduk->count() > 0) {
          $komisiProduk = $komisiProduk->first();
          TbsKomisiProduk::create(['no_reg' => $no_reg,
                                   'komisi_id' => $komisiProduk->id,
                                   'user_id'=> $petugas,
                                   'produk_id' => $produk,
                                   'nominal_komisi' => $komisiProduk->jumlah_uang]);
        }
      }
    }

    private function storeDetailKomisiProduk($no_reg,$no_trans){
      $tbsKomisiProduks = TbsKomisiProduk::where('no_reg',$no_reg)->get();
      foreach ($tbsKomisiProduks as $tbsKomisiProduk) {
        DetailKomisiProduk::create(['no_reg' => $tbsKomisiProduk->no_reg,
                                 'no_trans' => $no_trans,
                                 'komisi_id' => $tbsKomisiProduk->komisi_id,
                                 'user_id'=> $tbsKomisiProduk->user_id,
                                 'produk_id' => $tbsKomisiProduk->produk_id,
                                 'nominal_komisi' => $tbsKomisiProduk->nominal_komisi]);
      }
      TbsKomisiProduk::where('no_reg',$no_reg)->delete();
    }

    public function storeTbsEditPenjualan(Request $request,$id){

        $request->validate([
            'produk' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'penjamin' => 'required|numeric',
        ]);
        $produk = Produk::find($request->produk);
        $penjamin = Penjamin::find($request->penjamin);
        if($penjamin->level_harga === '1'){
          $totalNilai = $request->jumlah * $produk->harga_jual_1;
          $request->request->add(['harga_jual' => $produk->harga_jual_1]);
        } else if($penjamin->level_harga === '2'){
          $totalNilai = $request->jumlah * $produk->harga_jual_2;
          $request->request->add(['harga_jual' => $produk->harga_jual_2]);
        } else if($penjamin->level_harga === '3'){
          $totalNilai = $request->jumlah * $produk->harga_jual_3;
          $request->request->add(['harga_jual' => $produk->harga_jual_3]);
        }
        $penjualan = Penjualan::find($id);
        $request->request->add(['nama_produk' => $produk->nama]);
        $request->request->add(['no_trans' => $penjualan->no_trans]);
        $request->request->add(['penjualan_id' => $id]);
        $request->request->add(['total' => $totalNilai]);
        $getTbsEditPenjualan = TbsEditPenjualan::where('produk',$request->produk)
                                ->where('penjualan_id',$id)
                                ->where('created_by',Auth::user()->id)->count();
        if($getTbsEditPenjualan > 0){
          $tbsEditPenjualan = $this->updateTbsEditPenjualan($request);
        } else {
          $tbsEditPenjualan = TbsEditPenjualan::create($request->all());
        }

        if($tbsEditPenjualan){
          return response(200) ;
        } else {
          return response(500);
        }
    }

    public function updateTbsPenjualan($request){

        $updateTbsPenjualan = TbsPenjualan::where('produk',$request->produk)
                                ->where('no_reg',$request->no_reg)
                                ->update(['jumlah' => $request->jumlah]);
        if($updateTbsPenjualan){
          return true;
        } else {
          return false;
        }
    }

    public function updateTbsEditPenjualan($request,$id){

        $updateTbsEditPenjualan = TbsEditPenjualan::where('produk',$request->produk)
                                ->where('penjualan_id',$id)
                                ->where('created_by',Auth::user()->id)
                                ->update($request->all());
        if($updateTbsEditPenjualan){
          return true;
        } else {
          return false;
        }
    }

    public function search(Request $request){
       return Penjualan::where('nama','LIKE',"%$request->q%")
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
        return Penjualan::find($id);
    }
   /*
    function editDetailPenjualan ini di jalankan ketika form pertama
    kali di akses (mounted)
    data dari detail dimasukan ke edit tbs
   */
    public function editDetailPenjualan($id){
           TbsEditPenjualan::where('penjualan_id',$id)->where('created_by',Auth::user()->id)->delete();
           $detailPenjualan = DetailPenjualan::where('penjualan_id',$id)->get()->toArray();
           foreach($detailPenjualan as $detail){

             TbsEditPenjualan::create($detail);
           }

           return TbsEditPenjualan::where('penjualan_id',$id)->get();

    }
    // function editTbsPenjualan ini dijalankan ketika ada penambahkan produk, dan penghapusan produk
    public function editTbsPenjualan($id){

           return TbsEditPenjualan::where('penjualan_id',$id)->get();

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
            'penjamin' => 'required|numeric',
            'jumlah_bayar' => 'nullable|numeric',
            'piutang_awal' => 'nullable|numeric',
        ]);
        if($request->piutang_awal > 0){
          $statusBeliAwal = 'piutang';
        } else {
          $statusBeliAwal = 'tunai';
        }
        $jumlahProduk = count($request->detailPenjualanJalanInap);
        $kas = Kas::find($request->kas);
        $penjamin = Penjamin::find($request->penjamin);

        $request->request->add(['status_jual_awal' => $statusBeliAwal]);
        $request->request->add(['jumlah_produk' => $jumlahProduk]);
        $request->request->add(['nama_kas' => $kas->nama]);
        $request->request->add(['nama_penjamin' => $penjamin->nama]);

        $penjualan = Penjualan::find($id)->update($request->all());
        $detailPenjualan = $this->storeDetailPenjualan($request,$request->no_trans,$id);
        if($penjualan) {
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
        $penjualan = Penjualan::find($id);
        $penjualanDestroy = Penjualan::destroy($id);
        Persediaan::where('no_trans',$penjualan->no_trans)->delete();
        if($penjualanDestroy){
          return response(200);
        } else {
          return response(500);
        }
    }

    public function deleteTbsPenjualan($id){
      $tbsPenjualan = TbsPenjualan::find($id);
      TbsKomisiProduk::where('produk_id',$tbsPenjualan->produk)->delete();
      $tbsPenjualan->delete();

        if($tbsPenjualan){
          return response(200);
        } else {
          return response(500);
        }
    }

    public function deleteTbsEditPenjualan($id){
      $tbsEditPenjualan = TbsEditPenjualan::destroy($id);
        if($tbsEditPenjualan){
          return response(200);
        } else {
          return response(500);
        }
    }
}
