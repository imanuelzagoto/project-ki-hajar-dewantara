<?php

use App\Http\Controllers\API\HomeController;
use Illuminate\Http\Request;
use App\Http\Controllers\API\MasterProjekController;
use App\Http\Controllers\API\SuratPerintahKerjaController;
use App\Http\Controllers\API\PengajuanDanaController;
use App\Http\Controllers\API\UserServiceController;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [UserServiceController::class, 'loginUser'])->name('loginuser');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserServiceController::class, 'logout']);
    Route::get('/user', [UserServiceController::class, 'getUser']);
    Route::get('/user-data', [UserServiceController::class, 'getUserData']);
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
});

Route::prefix('mp')->group(function () {
    // Master Projek
    Route::get('master-projek', [MasterProjekController::class, 'index'])->name('master-projek.index');
    Route::post('master-projek', [MasterProjekController::class, 'store'])->name('master-projek.store');
    Route::get('master-projek/{id}', [MasterProjekController::class, 'show'])->name('master-projek.show');
    Route::patch('master-projek/{id}', [MasterProjekController::class, 'update'])->name('master-projek.update');
    Route::delete('master-projek/{id}', [MasterProjekController::class, 'destroy'])->name('master-projek.destroy');
});

Route::prefix('pd')->group(function () {
    // Pengajuan Dana
    Route::get('pengajuan-dana', [PengajuanDanaController::class, 'index'])->name('pengajuan-dana.index');
    Route::post('pengajuan-dana', [PengajuanDanaController::class, 'store'])->name('pengajuan-dana.store');
    Route::get('pengajuan-dana/{id}/export-pdf', [PengajuanDanaController::class, 'exportPDF'])->name('pengajuan-dana.export-pdf');
    Route::get('pengajuan-dana/{id}', [PengajuanDanaController::class, 'show'])->name('pengajuan-dana.show');
    Route::patch('pengajuan-dana/{id}', [PengajuanDanaController::class, 'update'])->name('pengajuan-dana.update');
    Route::delete('pengajuan-dana/{id}', [PengajuanDanaController::class, 'destroy'])->name('pengajuan-dana.destroy');
});

Route::prefix('spk')->group(function () {
    // surat perintah kerja
    Route::get('surat-perintah-kerja', [SuratPerintahKerjaController::class, 'index'])->name('surat-perintah-kerja.index');
    Route::post('surat-perintah-kerja', [SuratPerintahKerjaController::class, 'store'])->name('surat-perintah-kerja.store');
    Route::get('surat-perintah-kerja/{id}/export-pdf', [SuratPerintahKerjaController::class, 'exportPDF'])->name('surat-perintah-kerja.export-pdf');
    Route::get('surat-perintah-kerja/{surat_perintah_kerja}', [SuratPerintahKerjaController::class, 'show'])->name('surat-perintah-kerja.show');
    Route::patch('surat-perintah-kerja/{surat_perintah_kerja}', [SuratPerintahKerjaController::class, 'update'])->name('surat-perintah-kerja.update');
    Route::delete('surat-perintah-kerja/{surat_perintah_kerja}', [SuratPerintahKerjaController::class, 'destroy'])->name('surat-perintah-kerja.destroy');
});

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    // Endpoint untuk menampilkan semua data pengajuan dana
    Route::get('/pengajuan-dana-per-day', [HomeController::class, 'getPengajuanDanaPerDay']);

    // Endpoint untuk menampilkan semua data surat perintah kerja
    Route::get('surat-perintah-kerja', [HomeController::class, 'getAllSuratPerintahKerja'])->name('home.surat-perintah-kerja.all');
});
