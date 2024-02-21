<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuratPerintahKerjaController; // Import controller SuratPerintahKerjaController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// // Definisikan rute untuk menangani permintaan web
// Route::group(['prefix' => 'api'], function () {
//     // Rute untuk menampilkan daftar Surat Perintah Kerja
//     Route::get('/surat-perintah-kerja', [SuratPerintahKerjaController::class, 'index'])->name('api.surat-perintah-kerja.index');

//     // Rute untuk menambahkan Surat Perintah Kerja baru
//     Route::post('/surat-perintah-kerja', [SuratPerintahKerjaController::class, 'store']);

//     // Rute untuk menampilkan detail Surat Perintah Kerja berdasarkan ID
//     Route::get('/surat-perintah-kerja/{id}', [SuratPerintahKerjaController::class, 'show']);

//     // Rute untuk mengupdate Surat Perintah Kerja berdasarkan ID
//     Route::put('/surat-perintah-kerja/{id}', [SuratPerintahKerjaController::class, 'update']);

//     // Rute untuk menghapus Surat Perintah Kerja berdasarkan ID
//     Route::delete('/surat-perintah-kerja/{id}', [SuratPerintahKerjaController::class, 'destroy']);

//     // Rute untuk mengexport data Surat Perintah Kerja dalam format PDF
//     Route::get('/surat-perintah-kerja/export-pdf', [SuratPerintahKerjaController::class, 'exportPdf']);
// });
