<?php

use Illuminate\Support\Facades\Route;

//posts
Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
// surat perintah kerja
Route::apiResource('/surat-perintah-kerja', App\Http\Controllers\Api\SuratPerintahKerjaController::class);
