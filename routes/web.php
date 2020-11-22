<?php

use Illuminate\Support\Facades\Route;

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



Route::group(['middleware' => 'preventBackHistory'], function()
{   
    Auth::routes();
    
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::get('/search','HomeController@search');
    Route::get('/kategori/{kategori}', 'HomeController@kategori');
    Route::get('/detail/{id}','HomeController@detail');

    Route::get('/tiketcart','TiketCartController@index');

    Route::get('/transaksi/create/{id}','TransaksiController@create');
    Route::post('/transaksi/store/{id}', 'TransaksiController@store');
    Route::get('/transaksi/create/bukti/{id}', 'TransaksiController@createbukti');
    Route::post('/transaksi/store/bukti/{id}', 'TransaksiController@storebukti');
    Route::get('/transaksi/cancel/{id}','TransaksiController@cancel');
    Route::get('/transaksi/delete/{id}','TransaksiController@delete');

    Route::get('/cart','CartController@index');
    Route::get('/history','HistoryController@index');

    Route::get('/pdf/cetak/{id}','PdfController@index');

    Route::get('/event/mulai/{id}', 'EventController@mulai');
    Route::get('/event/selesai/{id}', 'EventController@selesai');
    Route::resource('event','EventController');

    Route::get('tiket/create/{id}', 'TiketController@create');
    Route::resource('tiket','TiketController');

    Route::resource('profile','ProfileController');

    Route::group(['middleware' => ['auth', 'checkRole:admin']],function(){
        Route::get('/cartadmin','Admin\OrderController@index');
        Route::get('/allevent','Admin\EventController@index');
        Route::get('/checktiket','Admin\EventController@tiket');
        Route::get('/checktiket/{kode}', 'Admin\EventController@checktiket');
        Route::get('/allevent/delete/{id}','Admin\EventController@destroy');
        Route::get('/order/history', 'Admin\HistoryController@index');
        Route::get('/order/konfirmasi/{id}', 'Admin\OrderController@konfirmasi');
        Route::get('/order/gagalkonfirmasi/{id}','Admin\OrderController@gagalkonfirmasi');
        Route::get('/order/cancel/{id}','Admin\OrderController@cancel');
    });

});
