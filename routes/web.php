<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\SiswaUjianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\ProfileController;

Route::view('/', 'welcome')->name('home');

Route::middleware('auth')->get('/dashboard', function () {
    return match (auth()->user()->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'guru' => redirect()->route('guru.dashboard'),
        'siswa' => redirect()->route('siswa.dashboard'),
        default => redirect()->route('profile.edit'),
    };
})->name('dashboard');

/*
|------------------------------------------------------------------
| Dashboard ADMIN & User Management
|------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
        Route::post('/import-siswa', [LaporanController::class, 'importSiswa'])->name('import-siswa');
        Route::resource('users', UserController::class)->except(['show']);
    });

/*
|------------------------------------------------------------------
| Modul GURU & ADMIN (Ujian, Soal, Mapel, Laporan)
|------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:guru,admin'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('guru.dashboard'))->name('dashboard');

        // Ujian Management
        Route::resource('ujian', UjianController::class)->except(['show']);
        Route::post('/ujian/{ujian}/attach', [UjianController::class, 'attachSoal'])->name('ujian.attach');
        Route::post('/ujian/{ujian}/toggle-status', [UjianController::class, 'toggleStatus'])->name('ujian.toggle-status');

        // Soal Management
        Route::middleware(['permission:kelola-soal'])->group(function () {
            Route::resource('soal', SoalController::class)->except(['show']);
        });

        // Mapel Management
        Route::resource('mapel', MapelController::class)->except(['show']);

        // Laporan
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{ujian}/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export-excel');
    });

/*
|------------------------------------------------------------------
| Modul SISWA (Dashboard, Pelaksanaan Ujian, Auto Grading, Hasil)
|------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {
        Route::get('/dashboard', [SiswaUjianController::class, 'index'])->name('dashboard');
        Route::get('/ujian/{ujian}/kerjakan', [SiswaUjianController::class, 'kerjakan'])->name('ujian.kerjakan');
        Route::post('/ujian/{ujian}/submit', [SiswaUjianController::class, 'submit'])->name('ujian.submit');
        Route::get('/ujian/{ujian}/hasil', [SiswaUjianController::class, 'hasil'])->name('ujian.hasil');
    });

/*
|------------------------------------------------------------------
| General Authenticated Routes
|------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:guru,admin'])->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{ujian}/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export-excel');
    Route::get('/laporan/{ujian}/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export-pdf');
});

require __DIR__ . '/auth.php';
