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



Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/detail/{id}','HomeController@detail');

Route::get('/transaksi/create/{id}','TransaksiController@create');
Route::post('/transaksi/store/{id}', 'TransaksiController@store');
Route::get('/transaksi/create/bukti/{id}', 'TransaksiController@createbukti');
Route::post('/transaksi/store/bukti/{id}' , 'TransaksiController@storebukti');
Route::get('/transaksi/cancel/{id}','TransaksiController@cancel');

Route::get('/cart','CartController@index');

Route::get('/event/mulai/{id}', 'EventController@mulai');
Route::get('/event/selesai/{id}', 'EventController@selesai');
Route::resource('event','EventController');

Route::get('tiket/create/{id}', 'TiketController@create');
Route::resource('tiket','TiketController');

Route::resource('profile','ProfileController');


Route::group(['Middleware' => ['CheckRole:admin']], function(){
    Route::resource('admin','AdminController');
});