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
use Illuminate\Support\Facades\Auth;



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


// UserService Login Logout
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('loginnew');

Route::get('/', function () {
    if (!Session::has('token')) {
        return view('auth.login');
    } else {
        return redirect('/dashboard');
    }
});

// Route::get('/register', function () {
//     return view('auth.register');
// })->name('registnew');

Route::post('/loginservice', function () {

    $loginServiceUrl = env('LOGIN_SERVICE_URL');
    $response = Http::post($loginServiceUrl, [
        'email' => request('email'),
        'password' => request('password'),
    ]);
    // dd($response['status']);
    if (!empty($response['status'])) {
        if ($response['status'] == 200) {
            $userData = $response['user'];
            $token = $response['token'];
            Session::put('token', $token);
            Session::put('user', $userData);

            $session = Session::get('token');

            return redirect()->route('home.index');
        } else {
            return redirect('/')->with('message', 'Failed Login, 404 Internal Server Error');
        }
    } else {
        return redirect('/')->with('message', 'Invalid Credentials');
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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeViewController::class, 'index'])->name('home.index');

    // Rute untuk pengajuan dana
    Route::get('/pengajuan-dana/edit/{id}', [HomeViewController::class, 'editPengajuanDana'])->name('pengajuan-dana.edit');
    Route::put('/pengajuan-dana/update/{id}', [HomeViewController::class, 'updatePengajuanDana'])->name('pengajuan-dana.update');
    Route::get('/pengajuan-dana/show/{id}', [HomeViewController::class, 'showPengajuanDana'])->name('pengajuan-dana.show');
    Route::get('/pengajuan-dana/delete/{id}', [HomeViewController::class, 'destroyPengajuanDana'])->name('pengajuan-dana.delete');

    // Rute untuk Surat Perintah Kerja
    Route::get('/surat-perintah-kerja/edit/{id}', [HomeViewController::class, 'editSuratPerintahKerja'])->name('surat-perintah-kerja.edit');
    Route::put('/surat-perintah-kerja/update/{id}', [HomeViewController::class, 'updateSuratPerintahKerja'])->name('surat-perintah-kerja.update');
    Route::get('/surat-perintah-kerja/show/{id}', [HomeViewController::class, 'showSuratPerintahKerja'])->name('surat-perintah-kerja.show');
    Route::get('/surat-perintah-kerja/delete/{id}', [HomeViewController::class, 'destroySuratPerintahKerja'])->name('surat-perintah-kerja.delete');
    // Routes Master Projek
    Route::get('/master-projek/data', [MasterProjekViewController::class, 'data'])->name('master-projek.data');
    Route::get('/master-projek', [MasterProjekViewController::class, 'index'])->name('master-projek.index');
    Route::get('/master-projek/tambah-perintah', [MasterProjekViewController::class, 'create'])->name('master-projek.create');
    Route::get('/master-projek/{id}/edit', [MasterProjekViewController::class, 'edit'])->name('master-projek.edit');
    Route::get('/master-projek/{id}', [MasterProjekViewController::class, 'show'])->name('master-projek.show');
    Route::delete('/master-projek/{id}', [MasterProjekViewController::class, 'destroy'])->name('master-projek.destroy');

    // Routes Pengajuan Dana
    Route::get('/pengajuan-dana/data', [PengajuanDanaViewWebController::class, 'data'])->name('pengajuanDana.data');
    Route::get('/pengajuan-dana', [PengajuanDanaViewWebController::class, 'index'])->name('pengajuanDana.index');
    Route::get('/pengajuan-dana/tambah-pengajuan', [PengajuanDanaViewWebController::class, 'create'])->name('pengajuanDana.create');
    Route::get('/pengajuan-dana/{id}/edit', [PengajuanDanaViewWebController::class, 'edit'])->name('pengajuanDana.edit');
    Route::get('/pengajuan-dana/{id}', [PengajuanDanaViewWebController::class, 'show'])->name('pengajuanDana.show');
    Route::delete('/pengajuan-dana/{id}', [PengajuanDanaViewWebController::class, 'destroy'])->name('pengajuanDana.destroy');

    // Routes Surat perintah kerja
    Route::get('/surat-perintah-kerja/data', [SuratPerintahKerjaViewWebController::class, 'data'])->name('surat_perintah_kerja.data');
    Route::get('/surat-perintah-kerja', [SuratPerintahKerjaViewWebController::class, 'index'])->name('surat_perintah_kerja.index');
    Route::get('/surat-perintah-kerja/tambah-perintah', [SuratPerintahKerjaViewWebController::class, 'create'])->name('suratPerintahKerja.create');
    Route::get('/surat-perintah-kerja/{id}/edit', [SuratPerintahKerjaViewWebController::class, 'edit'])->name('suratPerintahKerja.edit');
    Route::get('/surat-perintah-kerja/{id}', [SuratPerintahKerjaViewWebController::class, 'show'])->name('suratPerintahKerja.show');
    Route::delete('/surat-perintah-kerja/{id}', [SuratPerintahKerjaViewWebController::class, 'destroy'])->name('surat_perintah_kerja.destroy');
});
