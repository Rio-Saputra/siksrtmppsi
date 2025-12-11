<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\User\PermintaanKegiatanController as UserPermintaan;
use App\Http\Controllers\Admin\PermintaanKegiatanController as AdminPermintaan;
use App\Http\Controllers\User\ProfileController;

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');



// USER
Route::middleware(['auth'])->group(function () {
    Route::get('/user/permintaan', [UserPermintaan::class, 'index'])->name('user.permintaan');
    Route::post('/user/permintaan/store', [UserPermintaan::class, 'store'])->name('user.permintaan.store');
});

// ADMIN
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/permintaan', [AdminPermintaan::class, 'index'])->name('admin.permintaan');
    Route::post('/permintaan/{id}/approve', [AdminPermintaan::class, 'approve'])->name('admin.permintaan.approve');
    Route::post('/permintaan/{id}/reject', [AdminPermintaan::class, 'reject'])->name('admin.permintaan.reject');

    // ➕ ROUTE DELETE
    Route::delete('/permintaan/delete/{id}', [AdminPermintaan::class, 'destroy'])
        ->name('admin.permintaan.delete');
});

Route::get('/admin/about', function () {
    return view('admin.about');
})->name('admin.about')->middleware('auth');



Route::get('/admin/warga', [App\Http\Controllers\Admin\WargaController::class, 'index'])
     ->name('admin.warga');

Route::get('/admin/kegiatan', [KegiatanController::class, 'index'])->name('admin.kegiatan');
Route::post('/admin/kegiatan', [KegiatanController::class, 'store'])->name('admin.kegiatan.store');
Route::put('/admin/kegiatan/{id}', [KegiatanController::class, 'update'])->name('admin.kegiatan.update');
Route::delete('/admin/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('admin.kegiatan.destroy');
Route::get('/admin/kegiatan/events', [App\Http\Controllers\KegiatanController::class, 'getEvents'])->name('admin.kegiatan.events');

Route::get('/user/kegiatan/{id}', [KegiatanController::class, 'show'])->name('user.kegiatan.show');

//admin route
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/kegiatan', [AdminController::class, 'kegiatan'])->name('admin.kegiatan');

Route::get('/', function () {
    return view('welcome');
});

// REGISTER & LOGIN
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD BERDASARKAN ROLE
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware('auth')->name('user.dashboard');

Route::get('/user/about', function () {
    return view('user.about');
})->name('user.about')->middleware('auth');

Route::get('/user/kegiatan', 
    [App\Http\Controllers\User\UserKegiatanController::class, 'index']
)->name('user.kegiatan');


