<?php

use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showMahasiswaLogin'])->name('login');
Route::post('/login', [AuthController::class, 'loginMahasiswa'])->name('login.mahasiswa');

Route::get('/register', [AuthController::class, 'showMahasiswaRegister'])->name('register');
Route::post('/register', [AuthController::class, 'registerMahasiswa'])->name('register.mahasiswa');

Route::get('/admin', [AuthController::class, 'showAdminLogin'])->name('admin-login');
Route::post('/admin', [AuthController::class, 'loginAdmin'])->name('login.admin');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/transaction/pdf/{id}', function ($id) {
    $transaction = \App\Models\Transaction::with([
        'ijazah',
        'transkrip',
        'akta',
        'user',
        'province',
        'city'
    ])->find($id);

    if (!$transaction) {
        abort(404, 'Transaction not found');
    }

    return view('pdf.transaction', compact('transaction'));
})->name('transaction.pdf');

Route::get('refresh/captcha', [CaptchaController::class, 'refreshCaptcha'])->name('refresh.captcha');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.index');


    // Pengajuan Routes
    Route::prefix('admin/dashboard/transaksi')->name('admin.transaksi.')->group(function () {
        Route::get('/', [AdminTransactionController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminTransactionController::class, 'detail'])->name('detail');
        Route::post('/{id}/approve', [AdminTransactionController::class, 'approve'])->name('approve');
        Route::post('/{id}/approveAmbilKampus', [AdminTransactionController::class, 'approveAmbilKampus'])->name('approveAmbilKampus');
        Route::post('/{id}/acc', [AdminTransactionController::class, 'acc'])->name('acc');
        Route::post('/{id}/tolak', [AdminTransactionController::class, 'tolak'])->name('tolak');

    });

    Route::get('admin/dashboard/mahasiswa', [App\Http\Controllers\AdminStudentController::class, 'index'])->name('admin.student.index');
    Route::get('admin/dashboard/mahasiswa/create', [App\Http\Controllers\AdminStudentController::class, 'create'])->name('admin.student.create');
    Route::post('admin/dashboard/mahasiswa/store', [App\Http\Controllers\AdminStudentController::class, 'store'])->name('admin.student.store');
    Route::get('admin/dashboard/mahasiswa/{id}/edit', [App\Http\Controllers\AdminStudentController::class, 'edit'])->name('admin.student.edit');
    Route::post('admin/dashboard/mahasiswa/{id}/update', [App\Http\Controllers\AdminStudentController::class, 'update'])->name('admin.student.update');
    Route::delete('admin/dashboard/mahasiswa/{id}/delete', [App\Http\Controllers\AdminStudentController::class, 'delete'])->name('admin.student.delete');



});


// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    // dashboard route
    Route::get('mahasiswa/dashboard', function () {
        return view('mahasiswa.index');
    })->name('mahasiswa.index');

    // edit biodata route
    Route::get('mahasiswa/dashboard/edit-biodata', [BiodataController::class, 'index'])->name('biodata.index');
    Route::post('mahasiswa/biodata/update', [BiodataController::class, 'update'])->name('biodata.update');

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
        Route::post('/storeAmbilKampus', [TransactionController::class, 'storeAmbilKampus'])->name('storeAmbilKampus');
        Route::get('/{id}', [TransactionController::class, 'detail'])->name('detail');
        Route::post('/{id}/upload-bukti-pembayaran', [TransactionController::class, 'uploadPaymentProof'])->name('bukti_pembayaran');
        Route::post('/{id}/accept', [TransactionController::class, 'accept'])->name('konfirmasi_pengiriman');
    });

    Route::prefix('mahasiswa/dashboard/kurir')->name('mahasiswa.kurir.')->group(function () {
        Route::get('/', [TransactionController::class, 'kurir'])->name('index');
    });
});


Route::controller(RajaOngkirController::class)->prefix('api')->group(function () {
    Route::get('/check-ongkir/{destination_id}', 'checkOngkir');
    Route::get('/provinces', 'getProvinces');
    Route::get('/cities/{province_id}', 'getCities');
    Route::get('/cities', 'getAllCities');
});






Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('superadmin/dashboard', [App\Http\Controllers\SuperAdmin\DashboardController::class, 'index'])->name('superadmin.index');


    // Pengajuan Routes
    Route::prefix('superadmin/dashboard/transaksi')->name('superadmin.transaksi.')->group(function () {
        Route::get('/', [App\Http\Controllers\SuperAdmin\TransactionController::class, 'index'])->name('index');
        Route::get('/export', [App\Http\Controllers\SuperAdmin\TransactionController::class, 'export'])->name('export');
        Route::get('/{id}', [App\Http\Controllers\SuperAdmin\TransactionController::class, 'detail'])->name('detail');
        Route::post('/{id}/approve', [App\Http\Controllers\SuperAdmin\TransactionController::class, 'approve'])->name('approve');
        Route::post('/{id}/approveAmbilKampus', [App\Http\Controllers\SuperAdmin\TransactionController::class, 'approveAmbilKampus'])->name('approveAmbilKampus');
        Route::post('/{id}/acc', [App\Http\Controllers\SuperAdmin\TransactionController::class, 'acc'])->name('acc');
        Route::post('/{id}/tolak', [App\Http\Controllers\SuperAdmin\TransactionController::class, 'tolak'])->name('tolak');

    });

    Route::get('superadmin/dashboard/mahasiswa', [App\Http\Controllers\SuperAdmin\StudentController::class, 'index'])->name('superadmin.student.index');
    Route::get('superadmin/dashboard/mahasiswa/export', [App\Http\Controllers\SuperAdmin\StudentController::class, 'export'])->name('superadmin.student.export');
    Route::get('superadmin/dashboard/mahasiswa/create', [App\Http\Controllers\SuperAdmin\StudentController::class, 'create'])->name('superadmin.student.create');
    Route::post('superadmin/dashboard/mahasiswa/store', [App\Http\Controllers\SuperAdmin\StudentController::class, 'store'])->name('superadmin.student.store');
    Route::get('superadmin/dashboard/mahasiswa/{id}/edit', [App\Http\Controllers\SuperAdmin\StudentController::class, 'edit'])->name('superadmin.student.edit');
    Route::post('superadmin/dashboard/mahasiswa/{id}/update', [App\Http\Controllers\SuperAdmin\StudentController::class, 'update'])->name('superadmin.student.update');
    Route::delete('superadmin/dashboard/mahasiswa/{id}/delete', [App\Http\Controllers\SuperAdmin\StudentController::class, 'delete'])->name('superadmin.student.delete');

    Route::get('superadmin/dashboard/kurir', [App\Http\Controllers\SuperAdmin\KurirController::class, 'index'])->name('superadmin.kurir.index');
});

