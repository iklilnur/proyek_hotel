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

//route untuk user (customer)
Route::get('/','CustomerController@home_customer');
Route::get('/customer/login','CustomerController@login_customer');
Route::post('/customer/cek_customer','CustomerController@cek_customer');
Route::get('/customer/logout','CustomerController@logout_customer');
Route::get('/customer/signup','CustomerController@signup_customer');
Route::post('/customer/signup_customer','CustomerController@store_signup_customer');
Route::get('/rooms','CustomerController@rooms');
Route::get('/reservation','CustomerController@reservation');
Route::get('/reservation_confirmation','ReservasiController@reservation_confirmation');
Route::post('/customer/store_reservation','ReservasiController@store_reservation');
Route::get('/reservation/cetak_nota/{no_reservasi}','ReservasiController@cetak_nota');

//route untuk pegawai
Route::get('/pegawai/home_pegawai','PegawaiController@home_pegawai');
Route::get('/pegawai/list_pegawai','PegawaiController@read_pegawai');
Route::get('/pegawai/edit_pegawai/{no_pegawai}','PegawaiController@edit_pegawai');
Route::get('/pegawai/tambah_pegawai','PegawaiController@input_pegawai');
Route::post('/pegawai/store_pegawai','PegawaiController@store_pegawai');
Route::get('/pegawai/hapus_pegawai/{no_pegawai}','PegawaiController@delete_pegawai');
Route::post('/pegawai/update_pegawai','PegawaiController@update_pegawai');
Route::get('/pegawai/login_pegawai','PegawaiController@login_pegawai');
Route::post('/pegawai/cek_pegawai','PegawaiController@cek_pegawai');
Route::get('/pegawai/logout_pegawai','PegawaiController@logout_pegawai');
Route::get('/pegawai/search_pegawai','PegawaiController@search_pegawai');
Route::get('/pegawai/cetak_pdf_pegawai','PegawaiController@cetak_pdf');

//route untuk kamar
Route::get('/pegawai/list_kamar','KamarController@read_kamar');
Route::get('/pegawai/tambah_kamar','KamarController@input_kamar');
Route::post('/pegawai/store_kamar','KamarController@store_kamar');
Route::get('/pegawai/edit_kamar/{no_kamar}','KamarController@edit_kamar');
Route::post('/pegawai/update_kamar','KamarController@update_kamar');
Route::get('/pegawai/hapus_kamar/{no_kamar}','KamarController@delete_kamar');
Route::get('/pegawai/search_kamar','KamarController@search_kamar');

//route untuk reservasi
Route::get('/pegawai/list_reservasi','ReservasiController@read_reservasi');
Route::get('/pegawai/tambah_reservasi','ReservasiController@input_reservasi');
Route::get('/pegawai/konfirmasi_reservasi','ReservasiController@konfirmasi_reservasi');
Route::post('/pegawai/store_reservasi','ReservasiController@store_reservasi');
Route::get('/pegawai/hapus_reservasi/{no_reservasi}','ReservasiController@delete_reservasi');
Route::get('/pegawai/edit_reservasi/{no_reservasi}','ReservasiController@edit_reservasi');
Route::get('/pegawai/konfirmasi_edit_reservasi','ReservasiController@konfirmasi_edit_reservasi');
Route::post('/pegawai/update_reservasi','ReservasiController@update_reservasi');

//route untuk customer
Route::get('/pegawai/list_customer','CustomerController@read_customer');
Route::get('/pegawai/tambah_customer','CustomerController@input_customer');
Route::post('/customer/store_customer','CustomerController@store_customer');
Route::get('/pegawai/search_customer','CustomerController@search_customer');
Route::get('/pegawai/hapus_customer/{no_customer}','CustomerController@delete_customer');
Route::get('/pegawai/edit_customer/{no_customer}','CustomerController@edit_customer');
Route::post('/pegawai/update_customer','CustomerController@update_customer');