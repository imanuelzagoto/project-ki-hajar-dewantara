<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratPerintahKerjaViewWebController;
use App\Http\Controllers\PengajuanDanaViewWebController;
use App\Http\Controllers\HomeController;

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

Route::get('/', fn () => redirect()->route('login'));

Route::middleware([
    'auth:sanctum', config('jetstream.auth_session'), 'verified',
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Routes for Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/surat-perintah-kerja', [SuratPerintahKerjaViewWebController::class, 'index'])->name('surat_perintah_kerja.index');
    Route::get('/surat-perintah-kerja/data', [SuratPerintahKerjaViewWebController::class, 'data'])->name('surat_perintah_kerja.data');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/pengajuan-dana', [PengajuanDanaViewWebController::class, 'index'])->name('PD.index');
    Route::get('/pengajuan-dana/data', [PengajuanDanaViewWebController::class, 'data'])->name('PD.data');
    // Route::get('/pengajuan-dana', [PengajuanDanaController::class, 'index'])->name('PD.index');
});
