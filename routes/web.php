<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminSuperController;
use App\Http\Controllers\DetailAnggaranController;

// Login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard untuk masing-masing role
Route::middleware(['auth', 'role:admin super'])->group(function () {
    Route::get('/admin_super/dashboard', function () {
        return view('admin_super.dashboard');
    })->name('admin_super.dashboard');
});

Route::middleware(['auth', 'role:direktur'])->group(function () {
    Route::get('/direktur/dashboard', function () {
        return view('direktur.dashboard');
    })->name('direktur.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Anggaran - Akses untuk admin dan admin super
Route::middleware(['auth', 'role:admin,admin super'])->prefix('anggaran')->group(function () {
    Route::get('/', [AnggaranController::class, 'index'])->name('anggaran.index');
    Route::get('/create', [AnggaranController::class, 'create'])->name('anggaran.create');
    Route::post('/store', [AnggaranController::class, 'store'])->name('anggaran.store');
    Route::get('/{id}/show', [AnggaranController::class, 'show'])->name('anggaran.show');
    Route::put('/{id}/update', [AnggaranController::class, 'update'])->name('anggaran.update');
    Route::get('/{id}/edit', [AnggaranController::class, 'edit'])->name('anggaran.edit');
    Route::delete('/{id}/destroy', [AnggaranController::class, 'destroy'])->name('anggaran.destroy');
});

// Detail anggaran - Akses untuk admin dan admin super
Route::middleware(['auth', 'role:admin,admin super'])->prefix('detail-anggaran')->group(function () {
    Route::get('/', [DetailAnggaranController::class, 'index'])->name('detail-anggaran.index');
    Route::get('/create/{id_anggaran?}', [DetailAnggaranController::class, 'create'])->name('detail-anggaran.create');
    Route::post('/store', [DetailAnggaranController::class, 'store'])->name('detail-anggaran.store');
    Route::get('/{id}', [DetailAnggaranController::class, 'show'])->name('detail-anggaran.show');
    Route::get('/{id}/edit', [DetailAnggaranController::class, 'edit'])->name('detail-anggaran.edit');
    Route::put('/{id}', [DetailAnggaranController::class, 'update'])->name('detail-anggaran.update');
    Route::delete('/{id}', [DetailAnggaranController::class, 'destroy'])->name('detail-anggaran.destroy');
    Route::get('/detail-anggaran/anggaran/{id}', [DetailAnggaranController::class, 'showByAnggaran'])->name('detail-anggaran.showByAnggaran');
});

// View direktur - Akses untuk direktur dan admin super
Route::middleware(['auth', 'role:direktur,admin super'])->prefix('direktur')->name('direktur.')->group(function () {
    Route::get('/pengajuan-anggaran', [DirekturController::class, 'pengajuanAnggaran'])->name('pengajuan.index');
    Route::get('/pengajuan-anggaran/{id}', [DirekturController::class, 'showDetail'])->name('pengajuan.detail');
    Route::post('/pengajuan-anggaran/approve/{id}', [DirekturController::class, 'accAnggaran'])->name('pengajuan.acc');
});

// Admin super - Akses khusus admin super dengan tampilan khusus
Route::middleware(['auth', 'role:admin super'])->prefix('admin_super')->name('admin_super.')->group(function () {
    // Anggaran untuk admin super
    Route::get('/anggaran', [AdminSuperController::class, 'index'])->name('ASanggaran.index');
    Route::get('/create', [AdminSuperController::class, 'create'])->name('ASanggaran.create');
    Route::post('/store', [AdminSuperController::class, 'store'])->name('ASanggaran.store');
    Route::get('/{id}/show', [AdminSuperController::class, 'show'])->name('ASanggaran.show');
    Route::put('/{id}/update', [AdminSuperController::class, 'update'])->name('ASanggaran.update');
    Route::get('/{id}/edit', [AdminSuperController::class, 'edit'])->name('ASanggaran.edit');
    Route::delete('/{id}/destroy', [AdminSuperController::class, 'destroy'])->name('ASanggaran.destroy');
    Route::get('/anggaran/detail/{id}', [AdminSuperController::class, 'showByAnggaran'])->name('ASdetail-anggaran.showByAnggaran');
    
    // Detail anggaran untuk admin super
    Route::get('/detail-anggaran/create/{id_anggaran}', [DetailAnggaranController::class, 'createas'])->name('ASdetail-anggaran.create');
    
    // User management - hanya admin super
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});