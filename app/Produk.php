<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Persediaan;

class Produk extends Model
{
    //
    use AuditableTrait;
    protected $fillable = ['kode','nama','kategori_produk','harga_beli','harga_jual_1',
                            'harga_jual_2','harga_jual_3',
                            'satuan','tipe_produk'];
    public function getHargaPokokAttribute(){
         $sumJumlahMasuk = Persediaan::where('produk',$this->id)->sum('masuk');
         $sumHargaPokok = Persediaan::where('produk',$this->id)->where('keluar',null)->sum('harga_pokok');
         $sumHargaPokok = $sumHargaPokok * $sumHargaPokok;
         $rataRataHargaPokok = $sumHargaPokok / $sumJumlahMasuk ;
         return round($rataRataHargaPokok);
    }


    public function getStokAttribute(){
        
         $sumJumlahMasuk = Persediaan::where('produk',$this->id)->sum('masuk');
         $sumJumlahKeluar = Persediaan::where('produk',$this->id)->sum('keluar');
         $stok = $sumJumlahMasuk - $sumJumlahKeluar;
         return $stok;
    }
}
