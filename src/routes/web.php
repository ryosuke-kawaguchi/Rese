<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReserveController;

Route::controller(ShopController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/search', 'search')->name('search');
    Route::get('/detail/{id}', 'detail')->name('shop.detail');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(FavoriteController::class)->group(function(){
        Route::get('/favorite/toggle/{shopId}', 'toggle')->name('favorite.toggle');
        Route::get('/mypage', 'index')->name('mypage');
    });
    Route::controller(ReserveController::class)->group(function(){
        Route::post('/reserve', 'storeReservation')->name('reserve.store');
        Route::get('/done', 'showDone')->name('done');
        Route::delete('/reserve/{id}', 'destroy')->name('reserve.destroy');
        Route::put('/reserve/{id}', 'update')->name('reserve.update');
    });
});

Route::get('/thanks',function() {
    return view('thanks');
})->name('thanks');

