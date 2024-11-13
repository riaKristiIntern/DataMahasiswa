<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DosenProfileController;
use App\Http\Controllers\KaprodiProfileController;
use App\Http\Controllers\StudentProfileController;

// Root URL
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Halaman Login
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login-process', [LoginController::class, 'login_process'])->name('login-process');
});

// Halaman Dashboard 
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // role Kaprodi
    Route::middleware('role:kaprodi')->group(function () {
        Route::resource('/kaprodi/manage-class', ClassController::class)->parameters(['manage-class' => 'kelas',]);
        Route::resource('/kaprodi/manage-dosen', DosenController::class)->parameters(['manage-dosen' => 'dosen',]);

        Route::get('/kaprodi/profile', [KaprodiProfileController::class, 'profile'])->name('kaprodi.profile');
        Route::get('/kaprodi/edit', [KaprodiProfileController::class, 'edit'])->name('kaprodi.edit')->middleware('auth');
        Route::post('/kaprodi/update', [KaprodiProfileController::class, 'update'])->name('kaprodi.update')->middleware('auth');
    });

    // role dosen wali kelas
    Route::middleware('role:dosen wali')->group(function () {
        Route::get('/dosen-wali/profile', [DosenProfileController::class, 'profile'])->name('dosenWali.profile');
        Route::get('/dosen-wali/edit', [DosenProfileController::class, 'edit'])->name('dosenWali.edit')->middleware('auth');
        Route::post('/dosen-wali/update', [DosenProfileController::class, 'update'])->name('dosenWali.update')->middleware('auth');

        Route::resource('/dosen-wali/manage-mahasiswa', MahasiswaController::class)->except(['show'])->parameters(['manage-mahasiswa' => 'mahasiswa',]);
        Route::post('/dosen-wali/approve-request/{id}', [MahasiswaController::class, 'approveRequest'])->name('dosen.approveRequest');
        Route::post('/dosen-wali/reject-request/{id}', [MahasiswaController::class, 'rejectRequest'])->name('dosen.rejectRequest');
        Route::get('/dosen-wali/permohonan', [MahasiswaController::class, 'showRequestEdit'])->name('dosen.requestApproval');
    });

    // role dosen biasa
    Route::middleware('role:dosen')->group(function () {
        Route::get('/dosen/profile', [DosenProfileController::class, 'profile'])->name('dosenBiasa.profile');
        Route::get('/dosen/edit', [DosenProfileController::class, 'edit'])->name('dosenBiasa.edit')->middleware('auth');
        Route::post('/dosen/update', [DosenProfileController::class, 'update'])->name('dosenBiasa.update')->middleware('auth');
    });

    // role mahasiswa
    Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
        Route::get('/mahasiswa/profile', [StudentProfileController::class, 'profile'])->name('mahasiswa.index');
        Route::get('/mahasiswa/request-edit', [StudentProfileController::class, 'showRequestEditForm'])->name('mahasiswa.requestEditForm');
        Route::post('/mahasiswa/request-edit', [StudentProfileController::class, 'requestEdit'])->name('mahasiswa.requestEdit');
        Route::post('/mahasiswa/save-edit', [StudentProfileController::class, 'saveEdit'])->name('mahasiswa.saveEdit');
    });

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
