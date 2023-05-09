<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaMatkulController;
use App\Http\Controllers\ArticleController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('mahasiswa', MahasiswaController::class);

Route::get('mahasiswa/nilai/{nim}', [MahasiswaController::class, 'khs']);

Route::resource('articles', ArticleController::class);

Route::get('mahasiswa/cetak/{nim}', [MahasiswaController::class, 'cetak'])->name('mahasiswa.cetak');

Route::get('/article/cetak_pdf', [ArticleController::class, 'cetak_pdf']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
