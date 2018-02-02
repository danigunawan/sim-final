<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrasiPasien;
use App\RekamMedik;
use App\Pasien;
use App\Perusahaan;
use App\RuanganTerpakai;

class RegistrasiRawatInapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return RegistrasiPasien::leftJoin('polis','polis.id','registrasi_pasiens.poli')
                    ->leftJoin('pasiens','pasiens.no_rm','registrasi_pasiens.pasien')
                    ->select('registrasi_pasiens.*','pasiens.nama AS nama_pasien', 'polis.nama AS nama_poli')
                    ->where('jenis_registrasi','rawat_inap')
                    ->where('status_registrasi','menunggu')
                    ->orderBy('id','desc')
                    ->paginate(10);
    }

    public function status($status)
    {
        //
        return RegistrasiPasien::leftJoin('polis','polis.id','registrasi_pasiens.poli')
                    ->leftJoin('pasiens','pasiens.no_rm','registrasi_pasiens.pasien')
                    ->select('registrasi_pasiens.*','pasiens.nama AS nama_pasien', 'polis.nama AS nama_poli')
                    ->where('jenis_registrasi','rawat_inap')
                    ->where('status_registrasi',$status)
                    ->orderBy('id','desc')
                    ->paginate(10);
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
    public function storeBaru(Request $request)
    {
        //

        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'penjamin' => 'required|numeric',
            'poli' => 'required|numeric',
            'dokter' => 'required|numeric',
            'ruangan' => 'required|numeric',
        ]);
        $noRm = Pasien::noRm();
        $perusahaan = Perusahaan::find(1);
        $pasien = Pasien::create(['no_rm' => $noRm,'nama' => $request->nama,
                                  'alamat' => $request->alamat,'no_telp' => $request->no_telp,
                                  'penjamin' => $request->penjamin,
                                  'jenis_kelamin' => $request->jenis_kelamin,
                                  'kode_perusahaan' => $perusahaan->kode,
                                  'tanggal_lahir' => $request->tanggal_lahir]);

        $noReg = RegistrasiPasien::noRegistrasiPasien();
        $request->request->add(['no_reg' => $noReg]);
        $request->request->add(['pasien' => $noRm]);
        $request->request->add(['jenis_registrasi' => 'rawat_inap']);
        $request->request->add(['status_registrasi' => 'menunggu']);
        $registrasi = RegistrasiPasien::create($request->all());
        $rekamMedik = RekamMedik::create(['registrasi' => $registrasi->id,
                                           'sistole_diastole' => $request->sistole_diastole,
                                           'frekuensi_pernapasan' => $request->frekuensi_pernapasan,
                                           'suhu' => $request->suhu,
                                           'nadi' => $request->nadi,
                                           'berat_badan' => $request->berat_badan,
                                           'tinggi_badan' => $request->tinggi_badan,
                                        ]);
        $ruangan = RuanganTerpakai::create(['ruangan' => $request->ruangan,
                                    'no_reg' => $noReg, 'status_ruangan' => 1]);
        if($registrasi){
           return response(200);  
         } else {
           return response(500);
         }
    }
    public function storeLama(Request $request)
    {
        //

        $request->validate([
            'no_rm' => 'required',
            'penjamin' => 'required|numeric',
            'poli' => 'required|numeric',
            'dokter' => 'required|numeric',
            'ruangan' => 'required|numeric',
        ]);
        $noReg = RegistrasiPasien::noRegistrasiPasien();
        $request->request->add(['no_reg' => $noReg]);
        $request->request->add(['pasien' => $request->no_rm]);
        $request->request->add(['jenis_registrasi' => 'rawat_inap']);
        $request->request->add(['status_registrasi' => 'menunggu']);
        $registrasi = RegistrasiPasien::create($request->all());
        $rekamMedik = RekamMedik::create(['registrasi' => $registrasi->id,
                                           'sistole_diastole' => $request->sistole_diastole,
                                           'frekuensi_pernapasan' => $request->frekuensi_pernapasan,
                                           'suhu' => $request->suhu,
                                           'nadi' => $request->nadi,
                                           'berat_badan' => $request->berat_badan,
                                           'tinggi_badan' => $request->tinggi_badan,
                                        ]);
        $ruangan = RuanganTerpakai::create(['ruangan' => $request->ruangan,
                                    'no_reg' => $noReg, 'status_ruangan' => 1]);
        if($registrasi){
           return response(200);  
         } else {
           return response(500);
         }
    }

    public function search(Request $request){
       return RegistrasiPasien::where('nama','LIKE',"%$request->q%")
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
        return RegistrasiPasien::find($id);
    }

    public function rawat($id)
    {
        //
        $rawat =  RegistrasiPasien::find($id)->update(['status_registrasi' => 'rawat']);
        if($rawat){
          return response(200) ;    
        } else {
          return response(500);    
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $itemMasuk = RegistrasiPasien::destroy($id);
        if($itemMasuk){
          return response(200);
        } else {
          return response(500);    
        }
    }
}

