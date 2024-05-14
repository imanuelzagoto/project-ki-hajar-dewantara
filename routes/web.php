<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeViewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MasterProjekViewController;
use App\Http\Controllers\PengajuanDanaViewWebController;
use App\Http\Controllers\SuratPerintahKerjaViewWebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

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
    if (!Session::has('token')) {
        return view('auth.login');
    } else {
        return redirect('/dashboard');
    }
});

Route::post('/loginservice', function () {
    $validator = Validator::make(request()->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ], [
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Email tidak valid',
        'password.required' => 'Password wajib diisi',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
        $loginServiceUrl = env('LOGIN_SERVICE_URL');
        $response = Http::post($loginServiceUrl, [
            'email' => request('email'),
            'password' => request('password'),
        ]);

        if (!empty($response['status']) && $response['status'] == 200) {
            $userData = $response['user'];
            $token = $response['token'];
            Session::put('token', $token);
            Session::put('user', $userData);

            return redirect()->route('home.index');
        } else {
            $errorMessage = 'Email atau password tidak valid';
            return redirect()->back()->withErrors(['login' => $errorMessage]);
        }
    } catch (\Throwable $th) {
        return redirect()->back()->withErrors(['login' => 'Terjadi kesalahan yang tidak terduga. Silakan coba lagi.']);
    }
})->name('loginservice');


Route::post('/logoutservice', function (Request $request) {
    Session::forget('token');
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
})->name('logoutService');
Route::get('/login', function () {
    if (!Session::has('token')) {
        return view('auth.login');
    } else {
        return redirect('/dashboard');
    }
});

// Routes Kihajar dewantara
Route::middleware(['middleware' => 'auth'])->group(function () {
    Route::get('/dashboard', [HomeViewController::class, 'index'])->name('home.index');

    // Rute HOME untuk pengajuan dana
    Route::get('/pengajuan-dana/edit/{id}', [HomeViewController::class, 'editPengajuanDana'])->name('pengajuan-dana.edit');
    Route::put('/pengajuan-dana/update/{id}', [HomeViewController::class, 'updatePengajuanDana'])->name('pengajuan-dana.update');
    Route::get('/pengajuan-dana/show/{id}', [HomeViewController::class, 'showPengajuanDana'])->name('pengajuan-dana.show');
    Route::get('/pengajuan-dana/delete/{id}', [HomeViewController::class, 'destroyPengajuanDana'])->name('pengajuan-dana.delete');

    // Rute HOME untuk Surat Perintah Kerja
    Route::get('/surat-perintah-kerja/edit/{id}', [HomeViewController::class, 'editSuratPerintahKerja'])->name('surat-perintah-kerja.edit');
    Route::put('/surat-perintah-kerja/update/{id}', [HomeViewController::class, 'updateSuratPerintahKerja'])->name('surat-perintah-kerja.update');
    Route::get('/surat-perintah-kerja/show/{id}', [HomeViewController::class, 'showSuratPerintahKerja'])->name('surat-perintah-kerja.show');
    Route::get('/surat-perintah-kerja/delete/{id}', [HomeViewController::class, 'destroySuratPerintahKerja'])->name('surat-perintah-kerja.delete');

    // Routes Master Projek
    Route::get('/master-projek', [MasterProjekViewController::class, 'index'])->name('master-projek.index');
    Route::get('/master-projek/tambah-perintah', [MasterProjekViewController::class, 'create'])->name('master-projek.create');
    Route::post('/master-projek/store', [MasterProjekViewController::class, 'store'])->name('master-projek.store');
    Route::put('/master-projek/update/{id}', [MasterProjekViewController::class, 'update'])->name('master-projek.update');
    Route::get('/master-projek/edit/{id}', [MasterProjekViewController::class, 'edit'])->name('master-projek.edit');
    Route::get('/master-projek/show/{id}', [MasterProjekViewController::class, 'show'])->name('master-projek.show');
    Route::get('/master-projek/delete/{id}', [MasterProjekViewController::class, 'destroy'])->name('master-projek.delete');

    // Routes Pengajuan Dana
    Route::get('/pengajuan-dana', [PengajuanDanaViewWebController::class, 'index'])->name('pengajuanDana.index');
    Route::get('/pengajuan-dana/tambah-pengajuan', [PengajuanDanaViewWebController::class, 'create'])->name('pengajuanDana.create');
    Route::post('/pengajuan-dana/store', [PengajuanDanaViewWebController::class, 'store'])->name('pengajuanDana.store');
    Route::put('/pengajuan-dana/update/{id}', [PengajuanDanaViewWebController::class, 'update'])->name('pengajuanDana.update');
    Route::get('/pengajuan-dana/edit/{id}', [PengajuanDanaViewWebController::class, 'edit'])->name('pengajuanDana.edit');
    Route::put('/pengajuan-dana/update/{id}', [PengajuanDanaViewWebController::class, 'update'])->name('pengajuanDana.update');
    Route::get('/pengajuan-dana/show/{id}', [PengajuanDanaViewWebController::class, 'show'])->name('pengajuanDana.show');
    Route::get('/pengajuan-dana/delete/{id}', [PengajuanDanaViewWebController::class, 'destroy'])->name('pengajuanDana.delete');

    // Routes Surat perintah kerja
    Route::get('/surat-perintah-kerja', [SuratPerintahKerjaViewWebController::class, 'index'])->name('surat_perintah_kerja.index');
    Route::get('/surat-perintah-kerja/tambah-perintah', [SuratPerintahKerjaViewWebController::class, 'create'])->name('suratPerintahKerja.create');
    Route::post('/surat-perintah-kerja/store', [SuratPerintahKerjaViewWebController::class, 'store'])->name('suratPerintahKerja.store');
    Route::put('/surat-perintah-kerja/update/{id}', [SuratPerintahKerjaViewWebController::class, 'update'])->name('suratPerintahKerja.update');
    Route::get('/surat-perintah-kerja/edit/{id}', [SuratPerintahKerjaViewWebController::class, 'edit'])->name('suratPerintahKerja.edit');
    Route::get('/surat-perintah-kerja/show/{id}', [SuratPerintahKerjaViewWebController::class, 'show'])->name('suratPerintahKerja.show');
    Route::get('/surat-perintah-kerja/delete/{id}', [SuratPerintahKerjaViewWebController::class, 'destroy'])->name('surat_perintah_kerja.delete');
});
