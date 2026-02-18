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
Route::get('/harga', [HomeController::class, 'harga'])->name('harga');

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

    Route::patch('/admin/pengajuan/{pengajuan}/data', [\App\Http\Controllers\Admin\PengajuanController::class, 'updateData'])
        ->name('admin.pengajuan.data');

    // PDF SIMAKSI
    Route::post('/admin/pengajuan/{pengajuan}/generate-pdf', [\App\Http\Controllers\Admin\SimaksiApprovalController::class, 'store'])
        ->name('admin.pengajuan.generate-pdf');
    Route::get('/admin/pengajuan/{pengajuan}/preview-pdf', [\App\Http\Controllers\Admin\SimaksiApprovalController::class, 'previewPDF'])
        ->name('admin.pengajuan.preview-pdf');
    Route::get('/admin/pengajuan/{pengajuan}/download-pdf', [\App\Http\Controllers\Admin\SimaksiApprovalController::class, 'downloadPDF'])
        ->name('admin.pengajuan.download-pdf');

    // Pengaturan
    Route::get('/admin/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])
        ->name('admin.settings.index');
    // Laporan
    Route::get('/admin/laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])
        ->name('admin.laporan.index');
    Route::get('/admin/laporan/export', [\App\Http\Controllers\Admin\LaporanController::class, 'export'])
        ->name('admin.laporan.export');
    Route::get('/admin/laporan/detail', [\App\Http\Controllers\Admin\LaporanController::class, 'getDataDetail'])
        ->name('admin.laporan.detail');

    Route::post('/admin/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])
        ->name('admin.settings.update');
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
