<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('mhs-login');
});

Route::get('/login', [AuthController::class, 'showMahasiswaLogin'])->name('mhs-login');
Route::post('/login', [AuthController::class, 'loginMahasiswa'])->name('login.mahasiswa');

Route::get('/admin', [AuthController::class, 'showAdminLogin'])->name('admin-login');
Route::post('/admin', [AuthController::class, 'loginAdmin'])->name('login.admin');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('dashboard');
});


// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [DocumentController::class, 'dashboard'])->name('dashboard');
    Route::post('/documents/store', [DocumentController::class, 'store'])->name('documents.store');
    Route::post('/documents/submit', [DocumentController::class, 'submit'])->name('documents.submit');
});
