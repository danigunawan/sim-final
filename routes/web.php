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
Route::get('/user/search', 'UserController@search')->middleware('auth');
Route::get('/user/{id}/konfirmasi', 'UserController@konfirmasiUser')->middleware('auth');
Route::resource('user','UserController')->middleware('auth');

Route::get('/satuan/view', 'SatuanController@index')->middleware('auth');
Route::get('/satuan/all', 'SatuanController@all')->middleware('auth');
Route::get('/satuan/search', 'SatuanController@search')->middleware('auth');
Route::resource('satuan','SatuanController')->middleware('auth');

Route::get('/poli/view', 'PoliController@index')->middleware('auth');
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
Route::resource('pasien','PasienController')->middleware('auth');

Route::get('/produk/view', 'ProdukController@index')->middleware('auth');
Route::get('/produk/all', 'ProdukController@all')->middleware('auth');
Route::get('/produk/search', 'ProdukController@search')->middleware('auth');
Route::resource('produk','ProdukController')->middleware('auth');

Route::get('/kas-masuk/view', 'KasMasukController@index')->middleware('auth');
Route::get('/kas-masuk/search', 'KasMasukController@search')->middleware('auth');
Route::resource('kas-masuk','KasMasukController')->middleware('auth');

Route::get('/kas-keluar/view', 'KasKeluarController@index')->middleware('auth');
Route::get('/kas-keluar/search', 'KasKeluarController@search')->middleware('auth');
Route::resource('kas-keluar','KasKeluarController')->middleware('auth');
