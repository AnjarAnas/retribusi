<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\TagihanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('list-transaksi', [TagihanController::class, 'listTransaksi']);
        Route::post('detail-transaksi', [TagihanController::class, 'detailTransaksi']);
        Route::get('list-tagihan', [TagihanController::class, 'listTagihan']);
        Route::post('bayar', [TagihanController::class, 'bayar']);
        Route::post('detail-tagihan', [TagihanController::class, 'detailTagihan']);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });
});
