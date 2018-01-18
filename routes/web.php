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
Route::get('/user/search', 'UserController@search')->middleware('auth');
Route::get('/user/{id}/konfirmasi', 'UserController@konfirmasiUser')->middleware('auth');
Route::resource('user','UserController')->middleware('auth');

Route::get('/satuan/view', 'SatuanController@index')->middleware('auth');
Route::get('/satuan/search', 'SatuanController@search')->middleware('auth');
Route::resource('satuan','SatuanController')->middleware('auth');

Route::get('/poli/view', 'PoliController@index')->middleware('auth');
Route::get('/poli/search', 'PoliController@search')->middleware('auth');
Route::resource('poli','PoliController')->middleware('auth');

Route::get('/kategori-produk/view', 'KategoriProdukController@index')->middleware('auth');
Route::get('/kategori-produk/search', 'KategoriProdukController@search')->middleware('auth');
Route::resource('kategori-produk','KategoriProdukController')->middleware('auth');

Route::get('/kategori-transaksi/view', 'KategoriTransaksiController@index')->middleware('auth');
Route::get('/kategori-transaksi/search', 'KategoriTransaksiController@search')->middleware('auth');
Route::resource('kategori-transaksi','KategoriTransaksiController')->middleware('auth');

Route::get('/supplier/view', 'SupplierController@index')->middleware('auth');
Route::get('/supplier/search', 'SupplierController@search')->middleware('auth');
Route::resource('supplier','SupplierController')->middleware('auth');
