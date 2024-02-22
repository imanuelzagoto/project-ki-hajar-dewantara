<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuratPerintahKerjaController;
use App\Http\Controllers\Api\PengajuanDanaController;
use App\Models\PengajuanDana;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('spk')->group(function () {
    // surat perintah kerja
    Route::get('surat-perintah-kerja', [SuratPerintahKerjaController::class, 'index'])->name('surat-perintah-kerja.index');
    Route::post('surat-perintah-kerja', [SuratPerintahKerjaController::class, 'store'])->name('surat-perintah-kerja.store');
    Route::get('surat-perintah-kerja/export-pdf', [SuratPerintahKerjaController::class, 'exportPDF'])->name('surat-perintah-kerja.export-pdf');
    Route::get('surat-perintah-kerja/{surat_perintah_kerja}', [SuratPerintahKerjaController::class, 'show'])->name('surat-perintah-kerja.show');
    Route::patch('surat-perintah-kerja/{surat_perintah_kerja}', [SuratPerintahKerjaController::class, 'update'])->name('surat-perintah-kerja.update');
    Route::delete('surat-perintah-kerja/{surat_perintah_kerja}', [SuratPerintahKerjaController::class, 'destroy'])->name('surat-perintah-kerja.destroy');
});

Route::prefix('pd')->group(function () {
    // Pengajuan Dana
    Route::get('pengajuan-dana', [PengajuanDanaController::class, 'index'])->name('pengajuan-dana.index');
    Route::post('pengajuan-dana', [PengajuanDanaController::class, 'store'])->name('pengajuan-dana.store');
    Route::get('pengajuan-dana/export-pdf', [PengajuanDanaController::class, 'exportPDF'])->name('pengajuan-dana.export-pdf');
    Route::get('pengajuan-dana/{id}', [PengajuanDanaController::class, 'show'])->name('pengajuan-dana.show');
    Route::patch('pengajuan-dana/{id}', [PengajuanDanaController::class, 'update'])->name('pengajuan-dana.update');
    Route::delete('pengajuan-dana/{id}', [PengajuanDanaController::class, 'destroy'])->name('pengajuan-dana.destroy');
});
