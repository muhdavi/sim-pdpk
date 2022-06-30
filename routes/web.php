<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DokumenPelaksanaanAnggaranController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsulanController;
use App\Http\Controllers\PerangkatDaerahController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

#Route::redirect('/', 'login')->name('home');

Route::get('/', [PegawaiController::class, 'home'])->name('home');
Route::get('/move', [PegawaiController::class, 'move'])->name('move');
Route::get('/dashboard', [PegawaiController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group( function () {
    Route::name('pegawai.')->group(function () {
        Route::prefix('pegawai')->group(function () {
            Route::get('/index', [PegawaiController::class, 'index'])->name('index');
            Route::get('/create', [PegawaiController::class, 'create'])->name('create');
            Route::post('/store', [PegawaiController::class, 'store'])->name('store');
            Route::get('/unit-kerja-select', [PegawaiController::class, 'selectUnitKerja'])->name('unitkerja.select');
            Route::get('/edit/{pegawai}', [PegawaiController::class, 'edit'])->name('edit');
            Route::post('/update/{pegawai}', [PegawaiController::class, 'update'])->name('update');
            Route::post('/destroy/{pegawai}', [PegawaiController::class, 'destroy'])->name('destroy');
            Route::get('/show/{pegawai}', [PegawaiController::class, 'show'])->name('show');
            Route::get('/reject/{pegawai}', [PegawaiController::class, 'reject'])->name('reject');
        });
    });

    Route::name('dpa.')->group(function () {
        Route::prefix('dpa')->group(function () {
            Route::get('/index', [DokumenPelaksanaanAnggaranController::class, 'index'])->name('index');
            Route::get('/create', [DokumenPelaksanaanAnggaranController::class, 'create'])->name('create');
            Route::post('/store', [DokumenPelaksanaanAnggaranController::class, 'store'])->name('store');
            Route::get('/show/{dpa}', [DokumenPelaksanaanAnggaranController::class, 'show'])->name('show');
            Route::post('/update/{dpa}', [DokumenPelaksanaanAnggaranController::class, 'update'])->name('update');
        });
    });

    Route::name('usulan.')->group(function () {
        Route::prefix('usulan')->group(function () {
            Route::get('/index', [UsulanController::class, 'index'])->name('index');
            Route::get('/create', [UsulanController::class, 'create'])->name('create');
            Route::get('/edit/{usulan}', [UsulanController::class, 'edit'])->name('edit');
            Route::put('/update/{usulan}', [UsulanController::class, 'update'])->name('update');
            Route::post('/store', [UsulanController::class, 'store'])->name('store');
            Route::post('/verifikasi-store', [UsulanController::class, 'verifikasi_store'])->name('verifikasi.store');
            Route::post('/pegawai-store', [UsulanController::class, 'pegawai_store'])->name('pegawai.store');
            Route::get('/pegawai/{usulan}', [UsulanController::class, 'pegawai'])->name('pegawai');
            Route::get('/verifikasi/{usulan}', [UsulanController::class, 'verifikasi'])->name('verifikasi');
            Route::get('/pertek/{usulan}', [UsulanController::class, 'pertek'])->name('pertek');
            Route::post('/pertek-store/{usulan}', [UsulanController::class, 'pertek_store'])->name('pertek.store');
            Route::get('/print/{usulan}', [UsulanController::class, 'print'])->name('print');
            Route::get('/show/{usulan}', [UsulanController::class, 'show'])->name('show');
            Route::get('/print-sk/{usulan}', [UsulanController::class, 'print_sk'])->name('print.sk');
        });
    });


    Route::name('absensi.')->group(function () {
        Route::prefix('absensi')->group(function () {
            Route::get('/index', [AbsensiController::class, 'index'])->name('index');
            Route::post('/store', [AbsensiController::class, 'store'])->name('store');
            Route::get('/edit/{pegawai}', [AbsensiController::class, 'edit'])->name('edit');
        });
    });

    Route::name('perangkat_daerah.')->group(function () {
        Route::prefix('perangkat_daerah')->group(function () {
            Route::get('/index', [PerangkatDaerahController::class, 'index'])->name('index');
            Route::get('/show/{satuankerja}', [PerangkatDaerahController::class, 'show'])->name('show');
            Route::get('/edit/{satuankerja}', [PerangkatDaerahController::class, 'edit'])->name('edit');
            Route::post('/update/{satuankerja}', [PerangkatDaerahController::class, 'update'])->name('update');
        });
    });

    Route::name('users.')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/index', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
        });
    });
});
