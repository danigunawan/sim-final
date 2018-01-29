<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/view', 'UserController@index')->middleware('auth');
Route::get('/user/all', 'UserController@all')->middleware('auth');
Route::get('/user/dokter', 'UserController@dokter')->middleware('auth');
Route::get('/user/search', 'UserController@search')->middleware('auth');
Route::get('/user/{id}/konfirmasi', 'UserController@konfirmasiUser')->middleware('auth');
Route::resource('user','UserController')->middleware('auth');

Route::get('/satuan/view', 'SatuanController@index')->middleware('auth');
Route::get('/satuan/all', 'SatuanController@all')->middleware('auth');
Route::get('/satuan/search', 'SatuanController@search')->middleware('auth');
Route::resource('satuan','SatuanController')->middleware('auth');

Route::get('/poli/view', 'PoliController@index')->middleware('auth');
Route::get('/poli/all', 'PoliController@all')->middleware('auth');
Route::get('/poli/search', 'PoliController@search')->middleware('auth');
Route::resource('poli','PoliController')->middleware('auth');

Route::get('/kategori-produk/view', 'KategoriProdukController@index')->middleware('auth');
Route::get('/kategori-produk/all', 'KategoriProdukController@all')->middleware('auth');
Route::get('/kategori-produk/search', 'KategoriProdukController@search')->middleware('auth');
Route::resource('kategori-produk','KategoriProdukController')->middleware('auth');

Route::get('/kategori-transaksi/view', 'KategoriTransaksiController@index')->middleware('auth');
Route::get('/kategori-transaksi/all', 'KategoriTransaksiController@all')->middleware('auth');
Route::get('/kategori-transaksi/search', 'KategoriTransaksiController@search')->middleware('auth');
Route::resource('kategori-transaksi','KategoriTransaksiController')->middleware('auth');

Route::get('/supplier/view', 'SupplierController@index')->middleware('auth');
Route::get('/supplier/all', 'SupplierController@all')->middleware('auth');
Route::get('/supplier/search', 'SupplierController@search')->middleware('auth');
Route::resource('supplier','SupplierController')->middleware('auth');

Route::get('/komisi-produk/view', 'KomisiProdukController@index')->middleware('auth');
Route::get('/komisi-produk/search', 'KomisiProdukController@search')->middleware('auth');
Route::resource('komisi-produk','KomisiProdukController')->middleware('auth');

Route::get('/kas/view', 'KasController@index')->middleware('auth');
Route::get('/kas/all', 'KasController@all')->middleware('auth');
Route::get('/kas/search', 'KasController@search')->middleware('auth');
Route::resource('kas','KasController')->middleware('auth');

Route::get('/penjamin/view', 'PenjaminController@index')->middleware('auth');
Route::get('/penjamin/all', 'PenjaminController@all')->middleware('auth');
Route::get('/penjamin/search', 'PenjaminController@search')->middleware('auth');
Route::resource('penjamin','PenjaminController')->middleware('auth');

Route::get('/perusahaan/view', 'PerusahaanController@index')->middleware('auth');
Route::get('/perusahaan/search', 'PerusahaanController@search')->middleware('auth');
Route::resource('perusahaan','PerusahaanController')->middleware('auth');

Route::get('/pasien/view', 'PasienController@index')->middleware('auth');
Route::get('/pasien/search', 'PasienController@search')->middleware('auth');
Route::get('/pasien/pencarian-registrasi', 'PasienController@pencarianRegistrasi')->middleware('auth');
Route::resource('pasien','PasienController')->middleware('auth');

Route::get('/produk/view', 'ProdukController@index')->middleware('auth');
Route::get('/produk/all', 'ProdukController@all')->middleware('auth');
Route::get('/produk/search', 'ProdukController@search')->middleware('auth');
Route::resource('produk','ProdukController')->middleware('auth');

Route::get('/transaksi-kas/view', 'TransaksiKasController@index')->middleware('auth');
Route::get('/transaksi-kas/laporan', 'TransaksiKasController@laporan')->middleware('auth');
Route::get('/transaksi-kas/search', 'TransaksiKasController@search')->middleware('auth');
Route::resource('transaksi-kas','TransaksiKasController')->middleware('auth');

Route::get('/kas-masuk/view', 'KasMasukController@index')->middleware('auth');
Route::get('/kas-masuk/search', 'KasMasukController@search')->middleware('auth');
Route::resource('kas-masuk','KasMasukController')->middleware('auth');

Route::get('/kas-keluar/view', 'KasKeluarController@index')->middleware('auth');
Route::get('/kas-keluar/search', 'KasKeluarController@search')->middleware('auth');
Route::resource('kas-keluar','KasKeluarController')->middleware('auth');

Route::get('/kas-mutasi/view', 'KasMutasiController@index')->middleware('auth');
Route::get('/kas-mutasi/search', 'KasMutasiController@search')->middleware('auth');
Route::resource('kas-mutasi','KasMutasiController')->middleware('auth');

Route::get('/item-masuk/view', 'ItemMasukController@index')->middleware('auth');
Route::get('/item-masuk/search', 'ItemMasukController@search')->middleware('auth');
Route::resource('item-masuk','ItemMasukController')->middleware('auth');

Route::get('/item-keluar/view', 'ItemKeluarController@index')->middleware('auth');
Route::get('/item-keluar/search', 'ItemKeluarController@search')->middleware('auth');
Route::resource('item-keluar','ItemKeluarController')->middleware('auth');

Route::get('/registrasi-rawat-jalan/view', 'RegistrasiRawatJalanController@index')->middleware('auth');
Route::get('/registrasi-rawat-jalan/search', 'RegistrasiRawatJalanController@search')->middleware('auth');
Route::get('/registrasi-rawat-jalan/{id}/rawat', 'RegistrasiRawatJalanController@rawat')->middleware('auth');
Route::post('/registrasi-rawat-jalan/lama', 'RegistrasiRawatJalanController@storeLama')->middleware('auth');
Route::post('/registrasi-rawat-jalan/baru', 'RegistrasiRawatJalanController@storeBaru')->middleware('auth');
Route::resource('registrasi-rawat-jalan','RegistrasiRawatJalanController')->middleware('auth');

Route::get('/pembelian/view', 'PembelianController@index')->middleware('auth');
Route::get('/pembelian/search', 'PembelianController@search')->middleware('auth');
Route::post('/pembelian/store-tbs-pembelian', 'PembelianController@storeTbsPembelian')->middleware('auth');
Route::post('/pembelian/{id}/store-tbs-edit-pembelian', 'PembelianController@storeTbsEditPembelian')->middleware('auth');
Route::delete('/pembelian/{id}/delete-tbs-pembelian', 'PembelianController@deleteTbsPembelian')->middleware('auth');
Route::delete('/pembelian/{id}/delete-tbs-edit-pembelian', 'PembelianController@deleteTbsEditPembelian')->middleware('auth');
Route::get('/pembelian/create-detail-pembelian', 'PembelianController@createDetailPembelian')->middleware('auth');
Route::get('/pembelian/{id}/edit-detail-pembelian', 'PembelianController@editDetailPembelian')->middleware('auth');
Route::get('/pembelian/{id}/edit-tbs-pembelian', 'PembelianController@editTbsPembelian')->middleware('auth');
Route::resource('pembelian','PembelianController')->middleware('auth');
