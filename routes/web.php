<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showMahasiswaLogin'])->name('login');
Route::post('/login', [AuthController::class, 'loginMahasiswa'])->name('login.mahasiswa');

Route::get('/admin', [AuthController::class, 'showAdminLogin'])->name('admin-login');
Route::post('/admin', [AuthController::class, 'loginAdmin'])->name('login.admin');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('dashboard');
});


// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    // dashboard route
    Route::get('mahasiswa/dashboard', function () {
        return view('mahasiswa.index');
    })->name('mahasiswa.index');

    // legalisir route
    Route::prefix('mahasiswa/dashboard/legalisir')->name('mahasiswa.legalisir.')->group(function () {
        Route::get('/', [DocumentController::class, 'index'])->name('index');
        Route::post('/store', [DocumentController::class, 'store'])->name('store');
    });

    // riwayat transaksi route
    Route::prefix('mahasiswa/dashboard/transaksi')->name('mahasiswa.transaksi.')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/create', [TransactionController::class, 'create'])->name('create');
        Route::post('/store', [TransactionController::class, 'store'])->name('store');
        Route::get('/{id}', [TransactionController::class, 'detail'])->name('detail');
        Route::post('/{id}/upload-bukti-pembayaran', [TransactionController::class, 'uploadPaymentProof'])->name('bukti_pembayaran');
    });
});
