<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjukanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\BlockAdminFromUserDashboard;
use App\Http\Controllers\SuratController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/harga', function () {
    return view('harga');
})->name('harga');

/*
|--------------------------------------------------------------------------
| USER (LOGIN WAJIB)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', BlockAdminFromUserDashboard::class])->group(function () {

    // Ajukan SIMAKSI
    Route::get('/ajukan', [AjukanController::class, 'index'])->name('ajukan');
    Route::post('/ajukan', [AjukanController::class, 'store'])->name('ajukan.store');

    // Re-upload (Revisi)
    Route::get('/ajukan/edit/{pengajuan}', [AjukanController::class, 'edit'])->name('ajukan.edit');
    Route::post('/ajukan/update/{pengajuan}', [AjukanController::class, 'update'])->name('ajukan.update');

    // Download template surat
    Route::get('/surat/download/{jenisKegiatan}', [SuratController::class, 'download'])
        ->name('surat.download')
        ->middleware('auth');

    // Dashboard user (riwayat pengajuan)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
*/
Route::get('/api/persyaratan', [AjukanController::class, 'getPersyaratan']);

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/pengajuan', [\App\Http\Controllers\Admin\PengajuanController::class, 'index'])
        ->name('admin.pengajuan.index');

    Route::get('/admin/pengajuan/{pengajuan}', [\App\Http\Controllers\Admin\PengajuanController::class, 'show'])
        ->name('admin.pengajuan.show');

    Route::patch('/admin/pengajuan/{pengajuan}/status', [\App\Http\Controllers\Admin\PengajuanController::class, 'updateStatus'])
        ->name('admin.pengajuan.status');
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN / REGISTER)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
