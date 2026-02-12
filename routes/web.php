<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetugasController;

// =======================
// LOGIN
// =======================
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses'])->name('login.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// =======================
// AUTH AREA
// =======================
Route::middleware('auth')->group(function () {

    // =======================
    // DASHBOARD
    // =======================
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/petugas/dashboard', [PetugasController::class, 'index'])
        ->name('petugas.dashboard');

    // OWNER pakai controller
    Route::get('/owner/dashboard', [OwnerController::class, 'index'])
        ->name('owner.dashboard');

    // OWNER laporan
    Route::get('/owner/laporan', [OwnerController::class, 'laporan'])
        ->name('owner.laporan');


    // =======================
    // KELOLA USER
    // =======================
    Route::resource('user', UserController::class);

    // =======================
    // TARIF PARKIR
    // =======================
    Route::resource('tarif', TarifController::class);

    // =======================
    // AREA PARKIR
    // =======================
    Route::resource('area', AreaController::class);

    // =======================
    // DATA KENDARAAN
    // =======================
    Route::resource('kendaraan', KendaraanController::class);
    Route::get('/kendaraan/{id}/exit', [KendaraanController::class, 'exitForm'])->name('kendaraan.exit');
    Route::post('/kendaraan/{id}/process-exit', [KendaraanController::class, 'processExit'])->name('kendaraan.processExit');
    Route::get('/kendaraan/{id}/receipt/entry', [KendaraanController::class, 'printEntryReceipt'])->name('kendaraan.receipt.entry');
    Route::get('/kendaraan/{id}/receipt/exit', [KendaraanController::class, 'printExitReceipt'])->name('kendaraan.receipt.exit');

    // =======================
    // LOG
    // =======================
    Route::get('/log', [LogController::class,'index'])->name('log.index');

});
