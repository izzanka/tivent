<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\PdfController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\EventController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\TicketController;
use App\Http\Controllers\User\HistoryController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TicketCartController;
use App\Http\Controllers\Admin\OrderController as OrderAdmin;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/event/{event}/detail',[EventController::class,'detail'])->name('event.detail');


Route::group(['middleware' => ['auth']], function(){

    //Profile
    Route::get('/profile',[ProfileController::class,'index'])->name('profile.index');
    Route::post('/profile/{user}',[ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile/{user}/destroy',[ProfileController::class,'destroy'])->name('profile.destroy');

    Route::group(['middleware' => ['can:isUser']],function(){
        //Event
        Route::resource('events',EventController::class);
        Route::get('/event/{event}/{set}',[EventController::class,'set_event'])->name('event.set');
        Route::get('/destroyImage/{image}/{event}',[EventController::class,'destroyImage'])->name('destroy.image');

        //Ticket
        Route::get('event/{event}/ticket/index',[TicketController::class,'index'])->name('ticket.index');
        Route::get('/event/{event}/ticket/create',[TicketController::class,'create'])->name('ticket.create');
        Route::post('/event/{event}/ticket',[TicketController::class,'store'])->name('ticket.store');
        Route::get('/event/{event}/ticket/{ticket}/edit',[TicketController::class,'edit'])->name('ticket.edit');
        Route::post('/event/ticket/{ticket}/update',[TicketController::class,'update'])->name('ticket.update');
        Route::get('/event/ticket/{ticket}/destroy',[TicketController::class,'destroy'])->name('ticket.destroy');

        //Order
        Route::get('/ticket/{ticket}/order',[OrderController::class,'index'])->name('order.index');
        Route::post('/ticket/{ticket}/order',[OrderController::class,'store'])->name('order.store');

        //Cart
        Route::get('/cart',[CartController::class,'index'])->name('cart.index');
        Route::get('/cart/order/{order}/cancel/{id}',[CartController::class,'cancel'])->name('cart.cancel');
        Route::get('/cart/order/{order}/checkout',[CartController::class,'cart_checkout'])->name('cart.checkout');
        Route::post('/cart/order/{order}/checkout',[CartController::class,'checkout'])->name('checkout');

        //History
        Route::get('/history',[HistoryController::class,'index'])->name('history.index');

        //TicketCart
        Route::get('/cart/ticket/{order}',[TicketCartController::class,'index'])->name('cart.ticket.index');
        Route::get('/cart/ticket/{orderdetail}/print',[PdfController::class,'index'])->name('cart.ticket.print');


    });

    Route::group(['middleware' => ['can:isAdmin']],function(){
        Route::get('/order',[OrderAdmin::class,'index'])->name('order.admin.index');
        Route::get('/order/{order}/confirm/{status}',[OrderAdmin::class,'confirm'])->name('order.admin.confirm');
        Route::get('/order/history',[OrderAdmin::class,'history'])->name('order.admin.history');
    });
    
});
