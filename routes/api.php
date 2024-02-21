<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuratPerintahKerjaController;

// //posts
// Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);

// surat perintah kerja
// Route::apiResource('/surat-perintah-kerja', App\Http\Controllers\Api\SuratPerintahKerjaController::class);
Route::get('surat-perintah-kerja', [SuratPerintahKerjaController::class, 'index']);
Route::post('surat-perintah-kerja', [SuratPerintahKerjaController::class, 'store']);
Route::get('surat-perintah-kerja/export-pdf', [SuratPerintahKerjaController::class, 'exportPDF']);
Route::get('surat-perintah-kerja/{surat_perintah_kerja}', [SuratPerintahKerjaController::class, 'show']);
Route::patch('surat-perintah-kerja/{surat_perintah_kerja}', [SuratPerintahKerjaController::class, 'update']);
Route::delete('surat-perintah-kerja/{surat_perintah_kerja}', [SuratPerintahKerjaController::class, 'destroy']);
