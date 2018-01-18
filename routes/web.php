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
