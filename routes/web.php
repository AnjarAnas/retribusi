<?php

use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\RetribusiController;
use App\Http\Controllers\Admin\TipeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ObjekController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
});
Route::get('/table', function () {
    return view('admin.table');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('objek', [ObjekController::class, 'index'])->name('objek');
Route::get('retribusi', [RetribusiController::class, 'index'])->name('retribusi');
Route::post('scan', [RetribusiController::class, 'scan'])->name('scan');
Route::get('scanner', [RetribusiController::class, 'scanner'])->name('scanner');
// Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
Route::resource('kategori', KategoriController::class);
Route::resource('tipe', TipeController::class);
// Route::get('tipe', [TipeController::class, 'index'])->name('tipe');
Route::get('callback', [RetribusiController::class, 'callback'])->name('callback');
Route::get('add-role', function () {
    $user = User::where('name', 'njars')->first();
    $user->assignRole('admin');
})->name('role');
Route::group(['prefix' => 'petugas'], function () {
    Route::get('scan', [RetribusiController::class, 'scan'])->name('petugas.scan');
});

Route::get('retribusi-dashboard', function () {
    return view('retribusi-dashboard');
});
